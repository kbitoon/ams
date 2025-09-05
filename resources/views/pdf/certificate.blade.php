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
        }
    </style>
</head>

<body>
    <!-- Image Watermark -->
    <div class="watermark">
        <img src="{{ public_path('storage/' . $pdfContent->watermark) }}" alt="Watermark" style="width:100%; height:auto;">
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
            CERTIFICATION
        </div>
    </div>

    <p style="font-weight: lighter; font-style: italic; text-align: left; margin-top: 40px;">
        TO WHOM IT MAY CONCERN:
    </p>

    <p style="margin-top: 30px; text-indent: 40px;">
        This is to certify that <strong><u>{{ strtoupper($clearance->name ?? '________________') }}</u></strong>,
        a bona fide resident of Barangay Bacayan, Cebu City, with Voter’s Precinct No.
        <strong><u>{{ $clearance->precinct_no ?? '________' }}</u></strong>,
        is {{ $clearance->age ?? '___' }} years old and of <strong>GOOD MORAL CHARACTER</strong> and
        <strong>NO DEROGATORY</strong> record filed against him/her in this office as of the issuance of this clearance
        certificate.
    </p>

    <p style="text-indent: 40px;">
        This certification is issued upon request of the above-named person for the purpose of
        <b><u>{{ $clearance->purpose ?? '________________' }}</u></b>,
        and for whatever legal purpose it may serve.
    </p>

    <p style="text-indent: 40px;">
        Issued this <b>{{ date('jS', strtotime($clearance->date ?? now())) }}</b> day of
        <b>{{ date('F', strtotime($clearance->date ?? now())) }}</b>,
        20<b>{{ date('y', strtotime($clearance->date ?? now())) }}</b>,
        at Barangay Bacayan, Cebu City.
    </p>
    <table width="100%" style="margin-top: 60px;">
        <tr>
            <!-- Right Thumb Mark -->
            <td width="33%" align="center" style="vertical-align: bottom;">
                <div class="box"></div>
                <span style="font-size: 12px;">Right Thumb Mark</span>
            </td>

            <!-- Signature aligned with bottom of Thumb Mark -->
            <td width="34%" align="center" style="vertical-align: bottom; padding-bottom: 5px;">
                ____________________ <br>
                <span style="font-size: 12px;">Signature</span>
            </td>

            <!-- Barangay Captain with "Yours in Public Service" -->
            <td width="33%" align="center" style="vertical-align: top;">
                <div style="margin-bottom: 60px; font-size: 14px; font-style: italic;">
                    Yours in Public Service,
                </div>
                <u><b>{{ !empty($pdfContent?->captain) ? strtoupper($pdfContent->captain) : 'HON. JENELYN R. LEYSON' }}</b></u><br>
                <span style="font-size: 12px;">Punong Barangay</span>
            </td>
        </tr>
    </table>


    <!-- Payment Details -->
    <table width="100%" style="font-size: 13px; margin-top: 20px; border-collapse: collapse;">
        <tr>
            <td style="padding: 3px 0;">
                <b>Paid Under O.R. No.:</b>
                <span style="display:inline-block; width:150px; border-bottom:1px solid #000;">
                    &nbsp;
                </span>
            </td>
        </tr>
        <tr>
            <td style="padding: 3px 0;">
                <b>Amount:</b>
                <span style="display:inline-block; width:170px; border-bottom:1px solid #000; text-align:center;">
                    {{ $clearance->amount ?? '' }}
                </span>
            </td>
        </tr>
        <tr>
            <td style="padding: 3px 0;">
                <b>Control No.:</b>
                <span style="display:inline-block; width:160px; border-bottom:1px solid #000;">
                    &nbsp;
                </span>
            </td>
        </tr>
    </table>



    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('storage/' . $pdfContent->footer) }}" alt="Footer" style="width:100%; height:auto;">
    </div>
</body>

</html>