<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <style>
        .proton-body {
            display: block;
            padding: 0px;
            margin: 0px;
        }

        .proton-wrapper {
            width: 100%;
            display: block;
            overflow: hidden;
            box-sizing: border-box;
            color: #222;
            background: #f2f2fd;
            font-size: 18px;
            font-weight: normal;
            font-family: 'Baloo 2', 'Open Sans', 'Roboto', 'Segoe UI', 'Helvetica Neue', Helvetica, Tahoma, Arial, monospace, sans-serif;
        }

        .proton-table {
            border-collapse: collapse;
            border-spacing: 0;
            border: 0px;
            width: 640px;
            max-width: 90%;
            margin: 100px auto;
            box-shadow: 0px 20px 48px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .proton-table tr {
            background: #ffffff;
        }

        .proton-table td,
        .proton-table th {
            border: 0px;
            border-spacing: 0;
            border-collapse: collapse;
        }

        .proton-table tr td {
            padding: 0px 40px;
            box-sizing: border-box;
        }

        .proton-margin {
            float: left;
            width: 100%;
            overflow: hidden;
            height: 40px;
            padding-bottom: 0px;
            box-sizing: border-box;
        }

        .proton-div {
            float: left;
            width: 100%;
            overflow: hidden;
            box-sizing: border-box;
        }

        .proton-table h1,
        .proton-table h2,
        .proton-table h3,
        .proton-table h4 {
            float: left;
            width: 100%;
            margin: 0px 0px 20px 0px !important;
            padding: 0px;
        }

        .proton-table h1 {
            font-size: 33px;
        }

        .proton-table h2 {
            font-size: 26px;
        }

        .proton-table h3 {
            font-size: 23px;
        }

        .proton-table p {
            float: left;
            width: 100%;
            font-size: 18px;
            margin: 0px 0px 20px 0px !important;
        }

        .proton-table h4 {
            font-size: 20px;
        }

        .proton-table a {
            color: #6d49fc;
            font-weight: bold;
        }

        .proton-table a:hover {
            color: #55cc55;
        }

        .proton-table a:active {
            color: #ff6600;
        }

        .proton-table a:visited {
            color: #ff00ff;
        }

        .proton-table a.proton-link {
            display: inline-block;
            width: auto !important;
            outline: none !important;
            text-decoration: none !important;
        }

        .proton-table img,
        .proton-table a img {
            display: block;
            max-width: 100%;
            margin-bottom: 20px;
            border: 0px;
            border-radius: 10px;
            overflow: hidden;
        }

        .proton-table a.proton-button {
            display: inline-block;
            font-weight: bold;
            font-size: 17px;
            padding: 15px 40px;
            margin: 20px 0px;
            color: #ffffff !important;
            background: #8e33b0 !important;
            border-radius: 10px;
            text-decoration: none;
            outline: none;
        }

        .proton-table a.proton-button:hover {
            color: #ffffff !important;
            background: #55cc55 !important;
        }

        .proton-code {
            float: left;
            width: 100%;
            overflow: hidden;
            box-sizing: border-box;
            padding: 15px 40px;
            margin: 20px 0px;
            border: 1px dashed #f349fcaa;
            background: #6d49fc11;
            color: #ae34b7;
            font-weight: 700;
            font-size: 23px;
        }

        .proton-flex {
            float: left;
            width: 100%;
            text-align: center;
        }

        .proton-divider {
            float: left;
            width: 100%;
            overflow: hidden;
            margin: 20px 0px;
            border-top: 2px solid #f2f2fd;
        }
    </style>

    <style>
        /* your style here */
        .proton-flex img {
            margin: 10px;
            max-width: 15%;
            width: 40px;
        }
    </style>
</head>

<body>
    <div class="proton-wrapper">
        <table class="proton-table">
            <tbody>
                <tr>
                    <td>
                        <center>
                            <img  src= "https://firebasestorage.googleapis.com/v0/b/portf-cef98.appspot.com/o/logo2.png?alt=media&token=0e3d15c1-6500-4c42-a3ee-6b5527b4b76c"  alt="Sitharana Logo"  />
                        </center>
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h2>Session Cancellation Notice</h2>
                        <p>Dear <span class="highlight">{{ $userName ?? 'Valued Client' }}</span>,</p>

            <p>We regret to inform you that your scheduled session with <strong>{{$bookingTime }}   on {{ $bookingDate }}  </strong>  has been canceled due to the counselor’s unavailability.</p>

            <p>We apologize for any inconvenience this may cause. We understand that this might disrupt your plans, and we’re committed to helping you reschedule at a time that suits you.</p>

            <p>If you’d like to reschedule your session, please click the button below to view available times:</p>

            <center>
                <a href="{{ url('counsellors') }}" class="proton-button">Reshedule</a>
            </center>
            <p>Thank you for your understanding and patience. If you have any questions or need further assistance, please don’t hesitate to contact us.</p>

            <p>Contact Us : +94 714453450</p>
            <p>Email : sitharana@ssl.sab.ac.lk</p>


                    </td>
                </tr>
                <tr>
                    <td>
                        <h3>Best Regards,</h3>
                        <p>Sitharana Counseling Center<br>Sabaragamuwa University of Sri Lanka</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="proton-divider"></div>
                        <p class="footer">© 2025 Sitharana Psychological Counseling Center, SUSL</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
