<!DOCTYPE html>
<html>
    <head>
        <title>KP Form No. 7 – COMPLAINANT'S FORM</title>
        <style>
            body { font-family: Arial, sans-serif; font-size: 14px; margin: 0px 40px 0px 40px; line-height: 1.5;}
            .center { text-align: center; font-weight: bold; font-size: 16px; }
            .underline { border-bottom: 1px solid black; display: inline-block; width: 200px; }
            .short-underline { border-bottom: 1px solid black; display: inline-block; width: 100px; }
            .spacer { margin-bottom: 15px; }
            .complaint-text { text-align: justify; margin-top: 10px; }
            .signature { text-align: right; margin-top: 60px; }
            hr {border: 1px solid black; margin-top: 5px; margin-bottom: 18px;}
        </style>
        <table width="100%">
        <tr>
            <td width="20%" align="center">
                <img src="/storage/bacayan-logo.png" alt="Barangay Bacayan Logo" width="150">
            </td>
            <td width="70%" align="center">
                <p style="margin: 0; font-size: 14px;">REPUBLIC OF THE PHILIPPINES</p>
                <p style="margin: 0; font-size: 14px;">CEBU CITY</p>
                <p style="margin: 0; font-size: 16px; font-weight: bold;">BARANGAY BACAYAN</p>
                <p style="margin: 0; font-size: 12px;">Tel No.: 032-401-1927</p>
                <p style="margin: 0; font-size: 14px; font-weight: bold;">OFFICE OF THE BARANGAY CAPTAIN</p>
            </td>
            <td width="10%" align="center">
                <img src="/storage/cebucity.png" alt="Cebu City Official Seal" width="200">
            </td>
        </tr>
        </table>
        <hr>
    </head>
    
    <body>

    
        <p style ="font-weight: bold; margin: 5px 5px 0 0">Form No. 7 – COMPLAINANT'S FORM</p>
        <p class="center">OFFICE OF THE LUPONG TAGAPAMAYAPA</p>

        <table width="100%">
            <tr>
                <td width="50%">
                    @if($luponCase->luponCaseComplainants->isNotEmpty())
                        @foreach ($luponCase->luponCaseComplainants as $complainant)
                            <span>
                                <u>
                                    {{ "{$complainant->firstname} " }} 
                                    @if($complainant->middlename !== 'N/A') 
                                        {{ "{$complainant->middlename} " }} 
                                    @endif 
                                    {{ "{$complainant->lastname}" }}
                                </u>
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
                            <td><u>__________________________</u></td>
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
                                <u>
                                    {{ "{$respondent->firstname} " }} 
                                    @if($respondent->middlename !== 'N/A') 
                                        {{ "{$respondent->middlename} " }} 
                                    @endif 
                                    {{ "{$respondent->lastname}" }}
                                </u>
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
            I/WE hereby complain against above named respondent/s for violating my/our rights and interest in the following manner:
        </p>
        
        <div><u>{!! $luponCase->complaint !!}</u></div>

        <p>
            THEREFORE, I/WE pray that the following relief(s) be granted to me/us in accordance with law and/or equity:
        </p>

        <div><u>{!! $luponCase->prayer !!}</u></div>
        <p>
            Made this <u>{{ date('jS', strtotime($luponCase->date)) }}</u> 
            day of <u>{{ date('F', strtotime($luponCase->date)) }}</u>, 
            20<u>{{ date('y', strtotime($luponCase->date)) }}</u>.
        </p>

        <p class="signature">
            <span class="underline"></span><br>
            (Complainant/s)
        </p>

        <p>
            Received and filed this <u>{{ date('jS', strtotime($luponCase->date)) }}</u>
            day of <u>{{ date('F', strtotime($luponCase->date)) }}</u> 
            20<u>{{ date('y', strtotime($luponCase->date)) }}</u>.
        </p>

        <p class="signature">
           <u> <b>HON. WINSTON C. PEPITO</b></u> <br>
            <span style = "font-size: 10px;">Punong Barangay/Lupon Chairman</span>
        </p>

    </body>
</html>
