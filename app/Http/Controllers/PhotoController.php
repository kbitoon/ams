<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Required dimensions for banner photo
    private const BANNER_WIDTH = 1500;
    private const BANNER_HEIGHT = 400;

    public function upload(Request $request)
    {
        // Validate the uploaded photo (removed dimensions validation as we'll resize it)
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Increased max size to 10MB
        ]);

        $uploadedFile = $request->file('photo');
        
        // Get image dimensions
        $imageInfo = getimagesize($uploadedFile->getRealPath());
        if ($imageInfo === false) {
            return redirect()->back()->withErrors(['photo' => 'Invalid image file.']);
        }

        [$originalWidth, $originalHeight, $imageType] = $imageInfo;

        // Create image resource based on type
        $sourceImage = match ($imageType) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($uploadedFile->getRealPath()),
            IMAGETYPE_PNG => imagecreatefrompng($uploadedFile->getRealPath()),
            IMAGETYPE_GIF => imagecreatefromgif($uploadedFile->getRealPath()),
            default => null,
        };

        if ($sourceImage === null) {
            return redirect()->back()->withErrors(['photo' => 'Unsupported image format.']);
        }

        // Calculate crop/resize dimensions to maintain aspect ratio and fill the required size
        $targetAspect = self::BANNER_WIDTH / self::BANNER_HEIGHT;
        $originalAspect = $originalWidth / $originalHeight;

        // Determine source crop area
        if ($originalAspect > $targetAspect) {
            // Original is wider - crop width (center crop)
            $cropHeight = $originalHeight;
            $cropWidth = (int)($originalHeight * $targetAspect);
            $x = (int)(($originalWidth - $cropWidth) / 2);
            $y = 0;
        } else {
            // Original is taller - crop height (center crop)
            $cropWidth = $originalWidth;
            $cropHeight = (int)($originalWidth / $targetAspect);
            $x = 0;
            $y = (int)(($originalHeight - $cropHeight) / 2);
        }

        // Create a new image with target dimensions
        $resizedImage = imagecreatetruecolor(self::BANNER_WIDTH, self::BANNER_HEIGHT);

        // Preserve transparency for PNG and GIF
        if ($imageType === IMAGETYPE_PNG || $imageType === IMAGETYPE_GIF) {
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
            $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
            imagefill($resizedImage, 0, 0, $transparent);
        }

        // Resize and crop the image (this handles both upscaling and downscaling)
        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0, 0, $x, $y,
            self::BANNER_WIDTH,
            self::BANNER_HEIGHT,
            $cropWidth,
            $cropHeight
        );

        // Generate filename
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = time() . '_banner.' . $extension;
        $tempPath = sys_get_temp_dir() . '/' . $filename;

        // Save the resized image to temp file
        match ($imageType) {
            IMAGETYPE_JPEG => imagejpeg($resizedImage, $tempPath, 90),
            IMAGETYPE_PNG => imagepng($resizedImage, $tempPath, 9),
            IMAGETYPE_GIF => imagegif($resizedImage, $tempPath),
        };

        // Clean up memory
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);

        // Store the resized image
        $path = Storage::disk('public')->putFileAs('photos', new \Illuminate\Http\File($tempPath), $filename);

        // Clean up temp file
        @unlink($tempPath);

        // Save the photo path to the database
        Photo::create(['path' => $path]);

        return redirect()->back()->with('message', 'Photo uploaded and resized successfully!')->with('path', $path);
    }
}

