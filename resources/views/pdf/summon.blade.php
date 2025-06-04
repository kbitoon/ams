<!DOCTYPE html>
<html>

<head>
    <title>KP Form No. 9 – SUMMON FOR THE RESPONDENT</title>
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

        .signature {
            margin-top: 60px;
            text-align: right;
        }

        .spaced {
            margin-bottom: 12px;
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
    <p style="font-weight: bold; margin: 5px 5px 0 0">Form No. 9 – SUMMON FOR THE RESPONDENT</p>
    <p class="center">OFFICE OF THE LUPONG TAGAPAMAYAPA</p>

    <table width="100%">
        <tr>
            <td width="50%">
                @if($luponCase->luponCaseComplainants->isNotEmpty())
                    @foreach ($luponCase->luponCaseComplainants as $complainant)
                        <span>

                            <b>
                                {{ "{$complainant->firstname} " }}
                                @if($complainant->middlename !== 'N/A')
                                    {{ "{$complainant->middlename} " }}
                                @endif
                                {{ "{$complainant->lastname}" }}
                            </b>

                        </span><br>
                    @endforeach
                @else
                    <span><u>_________________________</u></span><br>
                @endif
                Complainant/s
            </td>
            <td width="50%" align="right">
                <table style="width: 100%;">
                    <tr>
                        <td align="right" style="white-space: nowrap;"><strong>Barangay Case No.:</strong></td>
                        <td><u>{{ $luponCase->case_no }}</u></td>
                    </tr>
                    <tr>
                        <td align="right" style="white-space: nowrap;"><strong>For:</strong></td>
                        <td><u>{{$luponCase->title}}</u></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>- against -</td>
            <td></td>
        </tr>
        <tr>
            <td>
                @if($luponCase->luponCaseRespondents->isNotEmpty())
                    @foreach ($luponCase->luponCaseRespondents as $respondent)
                        <span>

                            <b>
                                {{ "{$respondent->firstname} " }}
                                @if($respondent->middlename !== 'N/A')
                                    {{ "{$respondent->middlename} " }}
                                @endif
                                {{ "{$respondent->lastname}" }}
                            </b>

                        </span><br>
                    @endforeach
                @else
                    <span><u>_________________________</u></span><br>
                @endif
                Respondent/s
            </td>
        </tr>
    </table>

    <p class="center label spaced">SUMMONS</p>

    <p>
        <span style="font-weight: bold;">TO:</span>
        <br>
    <table style="border-collapse: collapse; margin-bottom: 0; margin-left: 40px;">
        @foreach ($luponCase->luponCaseRespondents as $respondent)
            <tr>
                <td style="border-bottom: 1px solid #000; width: 300px; padding-bottom: 2px;">
                    {{ $respondent->firstname }}
                    @if($respondent->middlename !== 'N/A') {{ $respondent->middlename }} @endif
                    {{ $respondent->lastname }}
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000; width: 320px; padding-bottom: 2px;">
                    {{ $respondent->address }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: center; border: none; padding-top: 4px;">
                <span style="font-size: 13px;">Respondent/s</span>
            </td>
        </tr>
    </table>
    </p>

    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;You are hereby summoned to appear before me in person, together with your witnesses, on
        the
        <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('jS') }}</strong> day of
        <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('F') }}</strong>,
        <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('Y') }}</strong>, at
        <strong>{{ \Carbon\Carbon::parse($summonedDate)->format('g:i A') }}</strong> o'clock in the
        morning/afternoon,
        then and there to answer to a complaint made before me, copy of which is attached hereto, for
        mediation/conciliation of your dispute with complainant/s.
    </p>

    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;You are hereby warned that if you refuse or willfully fail to appear in obedience to
        this summons,
        you may be barred from filing any counterclaim arising from said complaint.
    </p>

    <p><strong> &nbsp;&nbsp;&nbsp;&nbsp;FAIL NOT or else face punishment as for contempt of court.</strong></p>

    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;This
        <strong>{{ \Carbon\Carbon::parse($dateIssued)->format('jS') }}</strong> day of
        <strong>{{ \Carbon\Carbon::parse($dateIssued)->format('F') }}</strong>,
        <strong>{{ \Carbon\Carbon::parse($dateIssued)->format('Y') }}</strong>.
    </p>

    <div class="signature">
        <u><strong>HON. {{  strtoupper($pdfContent?->captain ?? 'HON. WINSTON C. PEPITO') }}</strong></u><br>
        <span style="font-size: 12px;">Punong Barangay/Pangkat Chairman</span>
    </div>

</body>

</html>