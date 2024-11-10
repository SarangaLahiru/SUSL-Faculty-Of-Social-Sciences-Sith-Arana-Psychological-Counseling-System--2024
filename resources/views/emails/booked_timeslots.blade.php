
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4e148c;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .field-label {
            font-weight: bold;
            color: #4e148c;
        }
        .message {
            background-color: #f8f9fa;
            border-left: 4px solid #4e148c;
            padding: 15px;
            border-radius: 8px;
            font-style: italic;
            color: #555;
            margin-top: 15px;
        }
        .footer {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Submission Details</h1>

        <p><span class="field-label">Mobile Number:</span> {{ $formDetails['mobile_no'] }}</p>
        <p><span class="field-label">Email:</span> {{ $formDetails['email'] }}</p>
        <p><span class="field-label">Faculty:</span> {{ $formDetails['faculty'] }}</p>

        @if(!empty($formDetails['name']))
            <p><span class="field-label">Name:</span> {{ $formDetails['name'] }}</p>
        @endif

        @if(!empty($formDetails['registration_no']))
            <p><span class="field-label">Registration Number:</span> {{ $formDetails['registration_no'] }}</p>
        @endif

        @if(!empty($formDetails['message']))
            <div class="message">
                <p><span class="field-label">Message:</span> {{ $formDetails['message'] }}</p>
            </div>
        @endif

        <div class="footer">
            <p>If you have any questions, feel free to reach out to us.</p>
        </div>
    </div>
</body>
</html>
