<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Post PDF</title>
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
            margin-bottom: 20px;
            box-shadow: 1px 1px 4px #ddd;
        }
        .card h2 {
            margin-top: 0;
            font-size: 22px;
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
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Post Details (ID: {{ $post->id }})</h2>

        <table class="details-table">
            <tr>
                <th>Title</th>
                <td>{{ ucfirst($post->title) }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $post->category->category_name }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ date('d M, Y', strtotime($post->created_at)) }}</td>
            </tr>
            <tr>
                <th>Author</th>
                <td>{{ $post->user->first_name ?? 'Unknown' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($post->status ?? 'N/A') }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
