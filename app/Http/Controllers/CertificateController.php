<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Models\PdfContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function downloadPdf($id)
    {
        $clearance = Clearance::findOrFail($id);

        // Generate verification token if not exists
        if (empty($clearance->verification_token)) {
            $clearance->verification_token = bin2hex(random_bytes(32));
            $clearance->save();
        }

        $clearance->age = $clearance->date_of_birth
            ? Carbon::parse($clearance->date_of_birth)->age
            : null;

        $pdfContent = PdfContent::orderBy('created_at', 'desc')->first();

        // Generate verification URL
        $verificationUrl = route('clearance.verify', ['token' => $clearance->verification_token]);

        // Generate QR code as SVG (doesn't require ImageMagick)
        $qrCodeFullPath = null;
        if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
            try {
                $qrCodePath = 'qr_codes/' . $clearance->verification_token . '.svg';
                // Use SVG format which doesn't require ImageMagick
                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(150)
                    ->errorCorrection('H')
                    ->generate($verificationUrl);
                
                // Save QR code to storage
                Storage::disk('public')->put($qrCodePath, $qrCode);
                $qrCodeFullPath = Storage::disk('public')->path($qrCodePath);
                
                // Verify file was created
                if (!file_exists($qrCodeFullPath)) {
                    \Log::error('QR Code file was not created at: ' . $qrCodeFullPath);
                    $qrCodeFullPath = null;
                }
            } catch (\Exception $e) {
                // QR code generation failed
                \Log::error('QR Code generation failed: ' . $e->getMessage());
                $qrCodeFullPath = null;
            }
        } else {
            \Log::warning('QR Code package not installed. Please run: composer require simplesoftwareio/simple-qrcode');
        }

        $pdf = Pdf::loadView('pdf.certificate', [
            'clearance' => $clearance,
            'pdfContent' => $pdfContent,
            'qrCodePath' => $qrCodeFullPath,
        ]);

        return $pdf->download("certificate_{$clearance->name}.pdf");
    }
    public function indigencyPdf($id)
    {
        $clearance = Clearance::findOrFail($id);

        // Generate verification token if not exists
        if (empty($clearance->verification_token)) {
            $clearance->verification_token = bin2hex(random_bytes(32));
            $clearance->save();
        }

        $clearance->age = $clearance->date_of_birth
            ? Carbon::parse($clearance->date_of_birth)->age
            : null;

        $pdfContent = PdfContent::orderBy('created_at', 'desc')->first();

        // Generate verification URL
        $verificationUrl = route('clearance.verify', ['token' => $clearance->verification_token]);

        // Generate QR code as SVG (doesn't require ImageMagick)
        $qrCodeFullPath = null;
        if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
            try {
                $qrCodePath = 'qr_codes/' . $clearance->verification_token . '.svg';
                // Use SVG format which doesn't require ImageMagick
                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(150)
                    ->errorCorrection('H')
                    ->generate($verificationUrl);
                
                // Save QR code to storage
                Storage::disk('public')->put($qrCodePath, $qrCode);
                $qrCodeFullPath = Storage::disk('public')->path($qrCodePath);
                
                // Verify file was created
                if (!file_exists($qrCodeFullPath)) {
                    \Log::error('QR Code file was not created at: ' . $qrCodeFullPath);
                    $qrCodeFullPath = null;
                }
            } catch (\Exception $e) {
                // QR code generation failed
                \Log::error('QR Code generation failed: ' . $e->getMessage());
                $qrCodeFullPath = null;
            }
        } else {
            \Log::warning('QR Code package not installed. Please run: composer require simplesoftwareio/simple-qrcode');
        }

        $pdf = Pdf::loadView('pdf.indigency', [
            'clearance' => $clearance,
            'pdfContent' => $pdfContent,
            'qrCodePath' => $qrCodeFullPath,
        ]);

        return $pdf->download("indigency_{$clearance->name}.pdf");
    }
    public function electricalPdf($id)
    {
        $clearance = Clearance::findOrFail($id);

        // Generate verification token if not exists
        if (empty($clearance->verification_token)) {
            $clearance->verification_token = bin2hex(random_bytes(32));
            $clearance->save();
        }

        $clearance->age = $clearance->date_of_birth
            ? Carbon::parse($clearance->date_of_birth)->age
            : null;

        $pdfContent = PdfContent::orderBy('created_at', 'desc')->first();

        // Generate verification URL
        $verificationUrl = route('clearance.verify', ['token' => $clearance->verification_token]);

        // Generate QR code as SVG (doesn't require ImageMagick)
        $qrCodeFullPath = null;
        if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
            try {
                $qrCodePath = 'qr_codes/' . $clearance->verification_token . '.svg';
                // Use SVG format which doesn't require ImageMagick
                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(150)
                    ->errorCorrection('H')
                    ->generate($verificationUrl);
                
                // Save QR code to storage
                Storage::disk('public')->put($qrCodePath, $qrCode);
                $qrCodeFullPath = Storage::disk('public')->path($qrCodePath);
                
                // Verify file was created
                if (!file_exists($qrCodeFullPath)) {
                    \Log::error('QR Code file was not created at: ' . $qrCodeFullPath);
                    $qrCodeFullPath = null;
                }
            } catch (\Exception $e) {
                // QR code generation failed
                \Log::error('QR Code generation failed: ' . $e->getMessage());
                $qrCodeFullPath = null;
            }
        } else {
            \Log::warning('QR Code package not installed. Please run: composer require simplesoftwareio/simple-qrcode');
        }

        $pdf = Pdf::loadView('pdf.electrical', [
            'clearance' => $clearance,
            'pdfContent' => $pdfContent,
            'qrCodePath' => $qrCodeFullPath,
        ]);
        return $pdf->download("electrical_{$clearance->name}.pdf");
    }

    public function verify($token)
    {
        $clearance = Clearance::where('verification_token', $token)->first();

        if (!$clearance) {
            return view('clearance.verification', [
                'valid' => false,
                'clearance' => null,
            ]);
        }

        // Load relationships
        $clearance->load(['type', 'approvedBy']);

        return view('clearance.verification', [
            'valid' => true,
            'clearance' => $clearance,
        ]);
    }
}
