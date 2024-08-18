<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>
    <h1>Form Submission Details</h1>
    <p><strong>Mobile Number:</strong> {{ $formDetails['mobile_no'] }}</p>
    <p><strong>Email:</strong> {{ $formDetails['email'] }}</p>
    <p><strong>Faculty:</strong> {{ $formDetails['faculty'] }}</p>
    @if(!empty($formDetails['name']))
        <p><strong>Name:</strong> {{ $formDetails['name'] }}</p>
    @endif
    @if(!empty($formDetails['registration_no']))
        <p><strong>Registration Number:</strong> {{ $formDetails['registration_no'] }}</p>
    @endif
    @if(!empty($formDetails['message']))
        <p><strong>Message:</strong> {{ $formDetails['message'] }}</p>
    @endif
</body>
</html>
