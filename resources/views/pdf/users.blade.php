<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            color: #333;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 1px 1px 4px #ddd;
        }
        .card h2 {
            font-size: 22px;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .details-table th {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>User Details (ID: {{ $user->id }})</h2>

        <table class="details-table">
            <tr>
                <th>Full Name</th>
                <td>{{ ucfirst($user->first_name) }} {{ $user->last_name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{ ucfirst($user->role) }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
