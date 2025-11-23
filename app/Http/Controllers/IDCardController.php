<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PdfContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class IDCardController extends Controller
{
    /**
     * Display QR code for ID card verification (for current user)
     */
    public function download()
    {
        $user = Auth::user();

        // Generate ID card token if not exists
        if (empty($user->id_card_token)) {
            $user->id_card_token = bin2hex(random_bytes(32));
            $user->save();
        }

        // Generate verification URL
        $verificationUrl = route('id-card.verify', ['token' => $user->id_card_token]);
        
        // Generate QR code
        $qrCode = null;
        if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
            try {
                // Generate QR code as SVG
                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(300)
                    ->errorCorrection('H')
                    ->generate($verificationUrl);
            } catch (\Exception $e) {
                \Log::error('ID Card QR Code generation failed: ' . $e->getMessage());
            }
        }
        
        return view('id-card.qr-code', [
            'user' => $user,
            'qrCode' => $qrCode,
            'verificationUrl' => $verificationUrl,
        ]);
    }

    /**
     * Display QR code for a specific user (for admins)
     */
    public function downloadForUser($userId)
    {
        // Check if user has permission (superadmin, admin, or support)
        $currentUser = Auth::user();
        if (!$currentUser->hasAnyRole(['superadmin', 'administrator', 'support'])) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($userId);

        // Generate ID card token if not exists
        if (empty($user->id_card_token)) {
            $user->id_card_token = bin2hex(random_bytes(32));
            $user->save();
        }

        // Generate verification URL
        $verificationUrl = route('id-card.verify', ['token' => $user->id_card_token]);
        
        // Generate QR code
        $qrCode = null;
        if (class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode')) {
            try {
                // Generate QR code as SVG
                $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                    ->size(300)
                    ->errorCorrection('H')
                    ->generate($verificationUrl);
            } catch (\Exception $e) {
                \Log::error('ID Card QR Code generation failed: ' . $e->getMessage());
            }
        }
        
        return view('id-card.qr-code', [
            'user' => $user,
            'qrCode' => $qrCode,
            'verificationUrl' => $verificationUrl,
        ]);
    }

    /**
     * Verify ID card token
     */
    public function verify($token)
    {
        $user = User::where('id_card_token', $token)->first();

        if (!$user) {
            return view('id-card.verification', [
                'valid' => false,
                'user' => null,
            ]);
        }

        // Load relationships
        $user->load('personalInformation');

        return view('id-card.verification', [
            'valid' => true,
            'user' => $user,
        ]);
    }
}
