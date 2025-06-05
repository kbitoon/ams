<!DOCTYPE html>
<>

    <head>
        <title>KP Form No. 9 – SUMMON FOR THE COMPLAINANT</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                margin: 0px 10px 0px 10px;
                line-height: 1.5;
            }

            .center {
                text-align: center;
                font-weight: bold;
            }

            .center-title {
                text-align: center;
                margin-bottom: 30px;
            }

            .center-title h3,{
                margin: 0;
                padding: 0;
                font-weight: bold;
            }
            .center-title h4 {
                margin: 0;
                padding: 0;
                font-weight: normal;
            }

            .section {
                margin-top: 40px;
            }

            .underline {
                border-bottom: 1px solid black;
                display: inline-block;
                min-width: 200px;
            }

            .label {
                font-weight: bold;
            }

            hr {
                border: 1px solid black;
            }

            .indent {
                text-indent: 40px;
            }

            .signature-block {
                margin-top: 50px;
                text-align: right;
            }

            .signature-line {
                display: inline-block;
                border-bottom: 1px solid black;
                width: 300px;
                margin-top: 30px;
            }

           

            .footer-block {
                margin-top: 50px;
                text-align: right;
            }

        </style>
        @if (!empty($pdfContent->header))
            <table width="100%">
                <tr>
                    <td width="100%" align="center">
                        <img src="{{ public_path('storage/' . $pdfContent->header) }}" alt="Header"
                            style="width: 100%; height: auto;">
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
    </head>

    <body>
        {{-- TITLE --}}
        <div class="center-title">
            <h3>NOTICE OF HEARING</h3>
            <h4>(MEDIATION PROCEEDINGS)</h4>
        </div>

        {{-- COMPLAINANT DETAILS --}}
        <div class="section">
            <strong>TO:</strong><br>
            <table style="margin-left: 40px;">
                @foreach ($luponCase->luponCaseComplainants as $complainant)
                    <tr>
                        <td class="underline">
                            {{ $complainant->firstname }}
                            @if($complainant->middlename !== 'N/A') {{ $complainant->middlename }} @endif
                            {{ $complainant->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <td class="underline">{{ $complainant->address }}</td>
                    </tr>
                @endforeach
                 <p style="text-align: center; font-size: 13px; margin-top: 4px;">Complainant/s</p>
            </table>
           
        </div>

        {{-- NOTICE BODY --}}
        <div class="section indent">
            You are hereby required to appear before me on the
            <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('jS') }}</strong> day of
            <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('F') }}</strong>,
            <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('Y') }}</strong> at
            <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('g:i A') }}</strong> o’clock in the
            morning/afternoon for the hearing of your complaint.
        </div>

        {{-- DATE OF ISSUANCE --}}
        <div class="section indent">
            This <strong>{{ \Carbon\Carbon::parse($dateIssued)->format('jS') }}</strong> day of
            <strong>{{ \Carbon\Carbon::parse($dateIssued)->format('F') }}</strong>,
            <strong>{{ \Carbon\Carbon::parse($dateIssued)->format('Y') }}</strong>.
        </div>

        {{-- SIGNATURE --}}
        <div class="signature-block">
            <strong><u>HON. {{ strtoupper($pdfContent?->captain ?? 'HON. WINSTON C. PEPITO') }}</u></strong><br>
            Punong Barangay
        </div>

        {{-- NOTIFICATION DATE --}}
        <div >
            Notified this __________ day of ____________________.
        </div>

        {{-- COMPLAINANT SIGNATURE --}}
        <div class="footer-block">
            <p>Complainant/s</p>
            <div class="signature-line"></div><br>
            <div class="signature-line"></div>
        </div>

    </body>

    </html>