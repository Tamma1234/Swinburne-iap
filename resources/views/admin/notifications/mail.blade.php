
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        /* Add any necessary styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="body">
        <p>{!! $content !!}</p>
    </div>
</div>
<div class="footer">
    <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
</div>
</body>
</html>
