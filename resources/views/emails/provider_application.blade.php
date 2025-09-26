<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Provider Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        h2 {
            color: #5b21b6;
            margin-bottom: 25px;
            text-align: center;
        }
        .field {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #374151;
        }
        .value {
            color: #111827;
            margin-top: 4px;
        }
        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 25px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📄 New Service Provider Application</h2>

        <div class="field">
            <div class="label">Provider Name:</div>
            <div class="value">{{ $data->name }}</div>
        </div>

        <div class="field">
            <div class="label">Shop Name:</div>
            <div class="value">{{ $data->shop_name }}</div>
        </div>

        <div class="field">
            <div class="label">Category:</div>
            <div class="value">{{ $data->category?->name ?? 'N/A' }}</div>
        </div>

        <div class="field">
            <div class="label">Subcategory:</div>
            <div class="value">{{ $data->subcategory?->name ?? 'N/A' }}</div>
        </div>

        <div class="field">
            <div class="label">State:</div>
            <div class="value">{{ $data->state?->name ?? 'N/A' }}</div>
        </div>

        <div class="field">
            <div class="label">City:</div>
            <div class="value">{{ $data->city?->name ?? 'N/A' }}</div>
        </div>

        <div class="field">
            <div class="label">Phone Number:</div>
            <div class="value">{{ $data->phone_number }}</div>
        </div>

        <div class="field">
            <div class="label">WhatsApp Number:</div>
            <div class="value">{{ $data->whatsapp ?? 'not provided' }}</div>
        </div>

        <div class="field">
            <div class="label">Facebook Page:</div>
            <div class="value">{{ $data->facebook ?? 'not provided' }}</div>
        </div>

        <div class="field">
            <div class="label">Instagram Page:</div>
            <div class="value">{{ $data->instagram ?? 'not provided' }}</div>
        </div>

        <div class="divider"></div>

        <div class="field">
            <div class="label">Description:</div>
            <div class="value">{{ $data->description }}</div>
        </div>

        @if($data->thumbnail)
            <div class="field">
                <div class="label">Thumbnail:</div>
                <div class="value">Uploaded ✅</div>
            </div>
        @endif

        <div class="footer">
            This email was generated automatically by FixMate.
        </div>
    </div>
</body>
</html>