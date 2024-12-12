<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Analysis</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .header h1 {
            font-size: 24px;
            color: #74148c;
        }
        .date {
            text-align: right;
            margin-bottom: 20px;
            font-size: 14px;
            color: #666;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            color: #74148c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #f4f4f4;
            color: #74148c;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://firebasestorage.googleapis.com/v0/b/portf-cef98.appspot.com/o/logo2.png?alt=media&token=0e3d15c1-6500-4c42-a3ee-6b5527b4b76c" alt="Logo" width="500px;">

        <h1>Overall Booking Analysis</h1>
    </div>

    <div class="date">
        Generated on: {{ now()->format('Y-m-d H:i:s') }}
    </div>

    <!-- Gender Distribution -->
    <div class="section">
        <h2>Gender Distribution</h2>
        <table>
            <thead>
                <tr>
                    <th>Gender</th>
                    <th>Total Bookings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genderData as $data)
                    <tr>
                        <td>{{ ucfirst($data->gender) }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Year-wise Distribution -->
    <div class="section">
        <h2>Year-wise Distribution</h2>
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Total Bookings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($yearData as $data)
                    <tr>
                        <td>{{ $data->year }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Faculty-wise Distribution -->
    <div class="section">
        <h2>Faculty-wise Distribution</h2>
        <table>
            <thead>
                <tr>
                    <th>Faculty</th>
                    <th>Total Bookings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facultyData as $data)
                    <tr>
                        <td>{{ $data->faculty }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Student vs Other Category -->
    <div class="section">
        <h2>Student vs Other Category</h2>
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Total Bookings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryData as $data)
                    <tr>
                        <td>{{ ucfirst($data->category) }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Counselor Performance with Pending and Done -->
    <div class="section">
        <h2>Counselor Performance</h2>
        <table>
            <thead>
                <tr>
                    <th>Counselor Name</th>
                    <th>Pending</th>
                    <th>Done</th>
                    <th>Total Bookings</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counselorPerformance as $data)
                    <tr>
                        <td>{{ $data->counselor_name }}</td>
                        <td>{{ $data->pending }}</td>
                        <td>{{ $data->done }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
