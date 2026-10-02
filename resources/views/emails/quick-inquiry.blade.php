<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Quick Inquiry</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f4f4;
            padding: 40px 20px;
        }
        .email-body_inner {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #111111;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            color: #111111;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            border-bottom: 2px solid #eeeeee;
            padding-bottom: 15px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #eeeeee;
            vertical-align: top;
        }
        .details-table tr:last-child td {
            border-bottom: none;
        }
        .label {
            width: 35%;
            color: #555555;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .value {
            width: 65%;
            color: #111111;
            font-size: 15px;
            line-height: 1.5;
        }
        .value a {
            color: #111111;
            text-decoration: none;
        }
        .footer {
            text-align: center;
            padding: 25px 20px;
            background-color: #fafafa;
            border-top: 1px solid #eeeeee;
        }
        .footer p {
            color: #999999;
            font-size: 13px;
            margin: 0;
        }
        @media only screen and (max-width: 600px) {
            .email-wrapper { padding: 20px 10px; }
            .content { padding: 30px 20px; }
            .label, .value { display: block; width: 100%; }
            .label { padding-bottom: 5px; }
            .value { padding-top: 0; }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-body_inner">
            <div class="header">
                <h1>Niaz Law P.C.</h1>
            </div>
            <div class="content">
                <div class="greeting">Quick Inquiry</div>
                
                <table class="details-table">
                    <tr>
                        <td class="label">Name</td>
                        <td class="value"><strong>{{ $data['name'] }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Email Address</td>
                        <td class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
                    </tr>
                    <tr>
                        <td class="label">Subject</td>
                        <td class="value">{{ $data['subject'] ?? 'No Subject' }}</td>
                    </tr>
                    <tr>
                        <td class="label" colspan="2" style="border-bottom: none; padding-bottom: 5px;">Message</td>
                    </tr>
                    <tr>
                        <td class="value" colspan="2" style="text-align: justify; padding-top: 0;">{!! nl2br(e($data['message'])) !!}</td>
                    </tr>
                </table>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Niaz Law P.C. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
