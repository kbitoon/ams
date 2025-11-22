<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance Verification - Barangay Bacayan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .verification-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }
        .status-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
        }
        .valid {
            background: #10b981;
            color: white;
        }
        .invalid {
            background: #ef4444;
            color: white;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #1f2937;
        }
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .info-card {
            background: #f9fafb;
            border-radius: 12px;
            padding: 25px;
            margin-top: 30px;
            text-align: left;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #374151;
        }
        .info-value {
            color: #1f2937;
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
        }
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .message {
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }
        .message-success {
            background: #d1fae5;
            color: #065f46;
            border: 2px solid #10b981;
        }
        .message-error {
            background: #fee2e2;
            color: #991b1b;
            border: 2px solid #ef4444;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        @if($valid && $clearance)
            <div class="status-icon valid">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 60px; height: 60px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1>Clearance Verified</h1>
            <p class="subtitle">This clearance certificate is authentic and valid</p>

            <div class="message message-success">
                <strong>✓ Valid Clearance</strong><br>
                This document has been verified and is authentic. The information below matches our records.
            </div>

            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Clearance Type:</span>
                    <span class="info-value">{{ $clearance->type->name ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ strtoupper($clearance->name) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date Issued:</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($clearance->date)->format('F j, Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">
                        <span class="badge {{ $clearance->status === 'Done' ? 'badge-success' : 'badge-pending' }}">
                            {{ $clearance->status }}
                        </span>
                    </span>
                </div>
                @if($clearance->approvedBy)
                <div class="info-row">
                    <span class="info-label">Approved By:</span>
                    <span class="info-value">{{ $clearance->approvedBy->name }}</span>
                </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Verification Code:</span>
                    <span class="info-value" style="font-family: monospace; font-size: 12px;">{{ substr($clearance->verification_token, 0, 8) }}...</span>
                </div>
            </div>
        @else
            <div class="status-icon invalid">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 60px; height: 60px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h1>Verification Failed</h1>
            <p class="subtitle">This clearance certificate could not be verified</p>

            <div class="message message-error">
                <strong>✗ Invalid or Expired</strong><br>
                The verification code provided does not match any clearance in our system. This document may be invalid, expired, or tampered with.
            </div>

            <div class="info-card" style="text-align: center; padding: 20px;">
                <p style="color: #6b7280; margin: 0;">
                    If you believe this is an error, please contact the Barangay Office for assistance.
                </p>
            </div>
        @endif

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
            <p style="color: #6b7280; font-size: 14px; margin: 0;">
                Barangay Bacayan, Cebu City<br>
                Clearance Verification System
            </p>
        </div>
    </div>
</body>
</html>

