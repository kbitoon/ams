<!DOCTYPE html>
<html>

<head>
    <title>KP Form No. 7 – COMPLAINANT'S FORM</title>
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
            font-size: 16px;
        }

        .underline {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 200px;
        }

        .short-underline {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 100px;
        }

        .spacer {
            margin-bottom: 15px;
        }

        .complaint-text {
            text-align: justify;
            margin-top: 10px;
        }

        .signature {
            text-align: right;
            margin-top: 60px;
        }

        hr {
            border: 1px solid black;
            margin-top: 5px;
            margin-bottom: 18px;
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


    <p style="font-weight: bold; margin: 5px 5px 0 0">Form No. 7 – COMPLAINANT'S FORM</p>
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

    <p class="center"><strong>COMPLAINT</strong></p>

    <p class="complaint-text">
        I/WE hereby complain against above named respondent/s for violating my/our rights and interest in the following
        manner:
    </p>

    <div style="font-style: italic; margin-left: 20px; margin-right: 20px;">
        {!! $luponCase->complaint !!}
    </div>

    <p>
        THEREFORE, I/WE pray that the following relief(s) be granted to me/us in accordance with law and/or equity:
    </p>

    <div style="font-style: italic; margin-left: 20px; margin-right: 20px;">
        {!! $luponCase->prayer !!}
    </div>
    <p>
        Made this <b>{{ date('jS', strtotime($luponCase->date)) }}</b>
        day of <b>{{ date('F', strtotime($luponCase->date)) }}</b>,
        20<b>{{ date('y', strtotime($luponCase->date)) }}</b>.
    </p>

    <p class="signature">
        <span class="underline"></span><br>
        (Complainant/s)
    </p>

    <p>
        Received and filed this <b>{{ date('jS', strtotime($luponCase->date)) }}</b>
        day of <b>{{ date('F', strtotime($luponCase->date)) }}</b>
        20<b>{{ date('y', strtotime($luponCase->date)) }}</b>.
    </p>

    <p class="signature">
        <u><b>HON.
                {{ !empty($pdfContent?->captain) ? strtoupper($pdfContent->captain) : 'HON. WINSTON C. PEPITO' }}</b></u>
        <br>
        <span style="font-size: 10px;">Punong Barangay/Lupon Chairman</span>
    </p>

</body>

</html>