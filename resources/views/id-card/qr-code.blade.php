<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card QR Code - {{ $user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .qr-code-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            margin: 20px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .qr-code-container svg {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .info {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: left;
        }

        .info-item {
            margin-bottom: 10px;
            color: #555;
            font-size: 14px;
        }

        .info-item strong {
            color: #333;
            display: inline-block;
            width: 120px;
        }

        .scan-text {
            margin-top: 15px;
            color: #667eea;
            font-weight: bold;
            font-size: 16px;
        }

        .verification-url {
            margin-top: 20px;
            padding: 10px;
            background: #f0f0f0;
            border-radius: 5px;
            word-break: break-all;
            font-size: 12px;
            color: #666;
        }

        .download-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .download-btn:hover {
            background: #5568d3;
        }

        @media print {
            body {
                background: white;
            }
            .container {
                box-shadow: none;
            }
            .download-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ID Card QR Code</h1>
        <p class="subtitle">Scan this QR code to verify your ID card</p>
        
        @if($qrCode)
            <div class="qr-code-container">
                {!! $qrCode !!}
            </div>
            <p class="scan-text">Scan with your phone camera</p>
        @else
            <div style="padding: 40px; color: #999;">
                <p>QR Code could not be generated. Please try again later.</p>
            </div>
        @endif

        <div class="info">
            <div class="info-item">
                <strong>Name:</strong> {{ $user->name }}
            </div>
            <div class="info-item">
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div class="info-item">
                <strong>ID Number:</strong> {{ substr($user->id_card_token, 0, 8) }}
            </div>
        </div>

        @if($verificationUrl)
        <div class="verification-url">
            <strong>Verification URL:</strong><br>
            {{ $verificationUrl }}
        </div>
        @endif

        <a href="javascript:window.print()" class="download-btn">Print QR Code</a>
    </div>
</body>
</html>

