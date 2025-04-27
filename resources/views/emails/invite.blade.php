<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Undangan untuk Bergabung dengan Harpa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2a9d8f;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }
        .button {
            display: inline-block;
            background-color: #2a9d8f;
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Undangan Bergabung dengan Harpa</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Anda telah diundang oleh Administrator untuk bergabung dengan aplikasi Harpa sebagai <strong>{{ ucfirst($invitation->role) }}</strong>.</p>
            <p>Silakan klik tombol di bawah ini untuk menerima undangan dan menyelesaikan proses registrasi menggunakan akun Google Anda:</p>

            <div style="text-align: center;">
                <a href="{{ $inviteUrl }}" class="button">Terima Undangan</a>
            </div>

            <p>Undangan ini akan kedaluwarsa pada: <strong>{{ $invitation->expires_at->format('d M Y, H:i') }}</strong></p>

            <p>Jika Anda tidak mengenali undangan ini, silakan abaikan email ini.</p>

            <p>Terima kasih,<br>Tim Harpa</p>
        </div>
        <div class="footer">
            <p>Email ini dikirim secara otomatis. Mohon jangan membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Harpa. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
