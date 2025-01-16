<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Email</title>

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

	<body class="proton-body">
        <div class="proton-wrapper">
            <table class="proton-table">
                <tbody>
                    <tr class="proton-tr">
                        <td class="proton-td" colspan="10">
                            <div class="proton-margin"></div>
                            <center>
                                <!-- <h1>Welcome!</h1> -->
                                <img src="https://firebasestorage.googleapis.com/v0/b/portf-cef98.appspot.com/o/logo2.png?alt=media&token=0e3d15c1-6500-4c42-a3ee-6b5527b4b76c" alt="Sith Arana Logo" />
                            </center>
                            <hr>
                        </td>
                    </tr>

                    <tr class="proton-tr">
    <td class="proton-td" colspan="10">
        <h2 style="text-align: center; font-size: 24px; color: #333;">Booking Cancellation Notification</h2>
        <p style="text-align: center; font-size: 16px; color: #555;">The following booking has been cancelled:</p>
        <center>
            <div class="proton-code" style="margin: 10px 0; font-size: 14px; color: #333;">
                <strong>Counsellor Name:</strong> {{ $counsellor->full_name_with_rate }}
            </div>
            <div class="proton-code" style="margin: 10px 0; font-size: 14px; color: #333;">
                <strong>Counsellor Phone:</strong> {{ $counsellor->phone }}
            </div>
            <h3 style="font-size: 18px; color: #333; margin: 20px 0;">Session Details</h3>
            <div class="proton-code" style="margin: 10px 0; font-size: 14px; color: #333;">
                <strong>Date:</strong> {{ $timeSlot->date }}
            </div>
            <div class="proton-code" style="margin: 10px 0; font-size: 14px; color: #333;">
                <strong>Time:</strong> {{ $timeSlot->time }}
            </div>
            <h3 style="font-size: 18px; color: #333; margin: 20px 0;">Client Details</h3>
            <div class="proton-code" style="margin: 10px 0; font-size: 14px; color: #333;">
                <strong>Client Name:</strong> {{ $booking->name }}
            </div>
            <div class="proton-code" style="margin: 10px 0; font-size: 14px; color: #333;">
                <strong>Client Email:</strong> {{ $booking->email }}
            </div>
        </center>
    </td>
</tr>


                   

                    <tr class="proton-tr">
                        <td class="proton-td" colspan="10">
                            <br />
                            <h3>Best Regards,</h3>
                            <p>
                                Sitharana Counseling Center<br>
                                Sabaragamuwa University of Sri Lanka
                            </p>
                        </td>
                    </tr>

                    <tr class="proton-tr">
                        <td class="proton-td" colspan="10">
                            <div class="proton-divider"></div>
                            <center>
                                <span class="proton-footer"> © 2025 Sitharana Psychological Counseling Center, SUSL</span>
                            </center>
                            <div class="proton-margin"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
	</body>
</html>
