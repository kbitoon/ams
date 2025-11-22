<!DOCTYPE html>
<html>

<head>
    <title>Barangay Clearance</title>
    <style>
        @page {
            margin: 0px 80px 0px 80px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            /* slightly taller lines */
            position: relative;
        }

        p {
            margin: 12px 0;
            line-height: 2;
            text-align: justify;
        }

        .center {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .signature {
            text-align: right;
            margin-top: 60px;
        }

        hr {
            border: 1px solid black;
            margin: 5px 0 18px 0;
        }

        .box {
            border: 1px solid black;
            width: 120px;
            height: 120px;
            text-align: center;
            vertical-align: middle;
            line-height: 120px;
            margin: 0 auto;
            font-size: 12px;
        }

        /* Image Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -1;
            width: 900px;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #333;
            z-index: 1;
        }

        /* QR Code */
        .qr-code {
            position: fixed;
            bottom: 10px;
            right: 20px;
            width: 100px;
            height: 100px;
            z-index: 1000;
            background: white;
            padding: 5px;
            border: 1px solid #ccc;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            display: block;
        }

        /* QR Code */
        .qr-code {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 120px;
            height: 120px;
            z-index: 1000;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Image Watermark -->
    <div class="watermark">
        <img src="{{ public_path('storage/' . $pdfContent->watermark) }}" alt="Watermark"
            style="width:100%; height:auto;">
    </div>

    {{-- Header --}}
    @if (!empty($pdfContent->header))
        <table width="100%" style="margin:0; padding:0; border-spacing:0;">
            <tr>
                <td width="100%" align="center" style="margin:0; padding:0;">
                    <img src="{{ public_path('storage/' . $pdfContent->header) }}" alt="Header"
                        style="width: 100%; height: auto; margin:0; padding:0;">
                </td>
            </tr>
        </table>
        <hr>
    @else
        <p style="text-align: center; color: red; font-style: italic;">
            No header image found. Please upload a header image in the settings.
        </p>
        <hr>
    @endif

    <div style="text-align: center; margin: 20px 0;">
        <div style="
        display: block;
        background-color: yellow;
        border: 2px solid #000;
        color: #000;
        font-family: 'Times New Roman', Times, serif;
        font-weight: bold;
        font-size: 22px;
        letter-spacing: 8px;
        padding: 10px 0;
        width: 100%;
        text-align: center;
    ">
            CERTIFICATE OF INDIGENCY
        </div>
    </div>

    <p style="font-weight: lighter; font-style: italic; text-align: left; margin-top: 40px;">
        TO WHOM IT MAY CONCERN:
    </p>

    <p style="margin-top: 30px; text-indent: 40px;">
        This is to certify that <strong><u>{{ strtoupper($clearance->name ?? '________________') }}</u></strong> is
        a resident of <strong><u>{{ strtoupper($clearance->address ?? '_____________________________________________') }}</u></strong> and that
        his/her property is located at 
        <strong><u>{{ strtoupper($clearance->address ?? '_____________________________________________') }}</u></strong>
        Barangay Bacayan, Cebu City.
    </p>

    <p style="text-indent: 40px;">
        This certification is issued upon request of  <strong><u>{{ strtoupper($clearance->name ?? '________________') }}</u></strong> in
        connection with their application for Fencing/ Building/ Electrical/ Renovation Permit with the office of the Building Officials (OBO), 
        Cebu City.
    </p>

    <p style="text-indent: 40px;">
        Done this <b>{{ date('jS', strtotime($clearance->date ?? now())) }}</b> day of
        <b>{{ date('F', strtotime($clearance->date ?? now())) }}</b>,
        20<b>{{ date('y', strtotime($clearance->date ?? now())) }}</b>,
        at Barangay Bacayan, Cebu City.
    </p>
    <table width="100%" style="margin-top: 80px;">
        <tr>
            <!-- Barangay Captain aligned right -->
            <td width="100%" align="right" style="vertical-align: top; text-align: right;">
                <div style="display: inline-block; text-align: center;">
                    <u><b>{{ !empty($pdfContent?->captain) ? strtoupper($pdfContent->captain) : 'HON. JENELYN R. LEYSON' }}</b></u><br>
                    <span style="font-size: 12px;">Barangay Captain</span>
                </div>
            </td>
        </tr>
    </table>



    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('storage/' . $pdfContent->footer) }}" alt="Footer" style="width:100%; height:auto;">
    </div>

    <!-- QR Code for Verification -->
    @if(isset($qrCodePath) && !empty($qrCodePath) && file_exists($qrCodePath))
    <div class="qr-code">
        <img src="{{ $qrCodePath }}" alt="Verification QR Code">
    </div>
    @endif
</body>

</html>