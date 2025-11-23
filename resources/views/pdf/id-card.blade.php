<!DOCTYPE html>
<html>
<head>
    <title>ID Card - {{ $user->name }}</title>
    <style>
        @page {
            margin: 0;
            size: 153.07pt 242.65pt portrait; /* 53.98mm x 85.6mm in points - portrait orientation */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            width: 153.07pt;
            height: 242.65pt;
            overflow: hidden;
        }

        .id-card-container {
            width: 153.07pt;
            height: 242.65pt;
            position: relative;
            background: #1e3a5f; /* Dark blue */
            border-radius: 8pt;
            overflow: hidden;
            page-break-inside: avoid;
            page-break-after: avoid;
            page-break-before: avoid;
            box-shadow: 0 2pt 4pt rgba(0,0,0,0.2);
        }

        /* Geometric Pattern Background */
        .pattern-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.15;
            background-image: 
                repeating-linear-gradient(45deg, transparent, transparent 10pt, rgba(255,255,255,0.1) 10pt, rgba(255,255,255,0.1) 20pt),
                repeating-linear-gradient(-45deg, transparent, transparent 10pt, rgba(255,255,255,0.1) 10pt, rgba(255,255,255,0.1) 20pt);
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 2;
            padding: 12pt;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Top Section - Logo/Header Area */
        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8pt;
        }

        .logo-area {
            flex: 1;
        }

        .id-number {
            font-size: 6pt;
            color: rgba(255,255,255,0.7);
            font-family: 'Courier New', monospace;
            text-align: right;
        }

        /* Middle Section - Name and Info */
        .middle-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            margin-bottom: 8pt;
        }

        .user-name {
            font-size: 16pt;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            margin-bottom: 4pt;
            letter-spacing: 0.5pt;
            line-height: 1.2;
        }

        .user-role {
            font-size: 9pt;
            color: #b8d4f0; /* Light blue */
            margin-bottom: 8pt;
            text-transform: uppercase;
            letter-spacing: 0.3pt;
        }

        .user-details {
            font-size: 7pt;
            color: #fff;
            line-height: 1.5;
        }

        .detail-line {
            margin-bottom: 3pt;
        }

        /* Right Section - Photo and QR */
        .right-section {
            position: absolute;
            right: 12pt;
            top: 12pt;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8pt;
        }

        .photo-section {
            width: 50pt;
            height: 50pt;
            border-radius: 50%;
            border: 2pt solid #fff;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 2pt 4pt rgba(0,0,0,0.3);
        }

        .photo-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3pt;
        }

        .qr-code {
            width: 45pt;
            height: 45pt;
            background: #fff;
            padding: 3pt;
            border-radius: 4pt;
            border: 1pt solid rgba(255,255,255,0.3);
            box-shadow: 0 2pt 4pt rgba(0,0,0,0.2);
        }

        .qr-code img {
            width: 100%;
            height: 100%;
        }

        .scan-text {
            font-size: 6pt;
            color: #b8d4f0;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5pt;
        }

        /* Bottom Section - Dates and Emergency */
        .bottom-section {
            margin-top: auto;
            font-size: 6pt;
            color: rgba(255,255,255,0.8);
            line-height: 1.4;
        }

        /* Back Side */
        .id-back {
            width: 153.07pt;
            height: 242.65pt;
            background: #f8f9fa;
            color: #000;
            padding: 12pt;
            display: flex;
            flex-direction: column;
            border-radius: 8pt;
            overflow: hidden;
            page-break-inside: avoid;
            box-shadow: 0 2pt 4pt rgba(0,0,0,0.2);
        }

        .back-header {
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
            margin-bottom: 12pt;
            text-transform: uppercase;
            color: #1e3a5f;
            letter-spacing: 1pt;
        }

        .signatures {
            display: flex;
            flex-direction: column;
            gap: 15pt;
            margin-bottom: 12pt;
            flex: 1;
            min-height: 0;
        }

        .signature-box {
            text-align: center;
        }

        .signature-line {
            border-top: 1pt solid #000;
            margin-top: 25pt;
            padding-top: 4pt;
        }

        .signature-name {
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #1e3a5f;
        }

        .signature-title {
            font-size: 6pt;
            margin-top: 2pt;
            color: #666;
        }

        .validity-text {
            text-align: center;
            font-size: 6pt;
            line-height: 1.5;
            padding: 8pt;
            background: #fff;
            border: 1pt solid #ddd;
            border-radius: 4pt;
            color: #333;
            margin-top: auto;
        }

        .page-break {
            page-break-after: always;
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <!-- Front Side -->
    <div class="id-card-container">
        <div class="pattern-background"></div>
        <div class="card-content">
            <div class="top-section">
                <div class="logo-area"></div>
                <div class="id-number">ID: {{ substr($user->id_card_token, 0, 8) }}</div>
            </div>
            
            <div class="middle-section">
                <div class="user-name">{{ strtoupper($user->name) }}</div>
                <div class="user-role">Resident</div>
                <div class="user-details">
                    <div class="detail-line">{{ strtoupper($address) }}</div>
                    <div class="detail-line">{{ $barangayName }}</div>
                    @if(isset($contactNumber) && $contactNumber)
                    <div class="detail-line">{{ $contactNumber }}</div>
                    @endif
                    <div class="detail-line">{{ $user->email }}</div>
                </div>
            </div>

            <div class="bottom-section">
                <div>Join: {{ $user->created_at->format('d/m/Y') }}</div>
            </div>
        </div>
        
        <div class="right-section">
            <div class="photo-section">
                @if(isset($photoBase64) && !empty($photoBase64))
                    <img src="{{ $photoBase64 }}" alt="User Photo">
                @else
                    <div style="width: 100%; height: 100%; background: #e0e0e0; display: flex; align-items: center; justify-content: center; font-size: 4pt; color: #666; text-align: center;">
                        NO<br>PHOTO
                    </div>
                @endif
            </div>
            <div class="qr-container">
                @if(isset($qrCodeBase64) && !empty($qrCodeBase64))
                <div class="qr-code">
                    <img src="{{ $qrCodeBase64 }}" alt="Verification QR Code">
                </div>
                <div class="scan-text">SCAN ME!</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>

    <!-- Back Side -->
    <div class="id-back">
        <div class="back-header">
            RESIDENT IDENTIFICATION CARD
        </div>

        <div class="signatures">
            <div class="signature-box">
                <div class="signature-line">
                    <div class="signature-name">{{ !empty($pdfContent?->captain) ? strtoupper($pdfContent->captain) : 'HON. JENELYN R. LEYSON' }}</div>
                    <div class="signature-title">Barangay Captain</div>
                </div>
            </div>

            <div class="signature-box">
                <div class="signature-line">
                    <div class="signature-name">{{ strtoupper($user->name) }}</div>
                    <div class="signature-title">Card Holder</div>
                </div>
            </div>
        </div>

        <div class="validity-text">
            <strong>VALIDITY</strong><br>
            This ID is valid for residents of {{ $barangayName }} only.<br>
            For verification, scan the QR code on the front.
        </div>
    </div>
</body>
</html>
