<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Sembark Invitation</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#f4f6f8; margin:0; padding:20px; } .container { max-width:600px; margin:20px auto; background:#ffffff; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.08); overflow:hidden; } .header { padding:20px; background:#0f62fe; color:#fff; text-align:center; } .header h1 { margin:0; font-size:20px; } .content { padding:24px; color:#111827; line-height:1.5; } .details { background:#f8fafc; border:1px solid #e6eef8; padding:12px; border-radius:6px; margin:16px 0; font-family:monospace; } .btn { display:inline-block; padding:12px 20px; background:#0f62fe; color:#fff; text-decoration:none; border-radius:6px; margin-top:12px; } .footer { padding:16px; text-align:center; color:#6b7280; font-size:13px; } @media (max-width:420px){ .content { padding:16px; } }
    </style>
</head>

<body>
    <div class="container" role="article" aria-label="Sembark Invitation">
        <div class="header">
            <h1>You're invited to Sembark</h1> </div>
        <div class="content">
            <p>Hello,</p>

            <p>You have been invited to <strong>Sembark URL Shortener</strong>. Below are your account details — please keep them secure.</p>

            <div class="details">
                <div><strong>E-Mail:</strong> {{ $email }}</div>
                <div><strong>Password:</strong> {{ $password }}</div>
            </div>

            <p>You can sign in and get started by clicking the button below:</p>

            <p>
                <a class="btn" href="{{ route('login') }}" target="_blank" rel="noopener">Login to Sembark</a>
            </p>

            <p>If the button doesn't work, copy and paste this link into your browser:</p>
            <p style="word-break:break-all;"><a href="{{ route('login') }}" target="_blank" rel="noopener">{{ route('login') }}</a></p>

            <p>If you didn't expect this invitation, please ignore this email.</p>

            <p>Regards,
                <br/> Mohammad Raquib</p>
        </div>

        <div class="footer">
            Sembark • Simple, fast URL shortening
        </div>
    </div>
</body>

</html>
