<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nomination received — ProBiz Awards 2026</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; color: #1a1a1a; line-height: 1.6; max-width: 600px; margin: 0 auto; padding: 24px;">
    <h2 style="margin-bottom: 4px;">ProBiz Awards 2026</h2>
    <p style="color: #666; margin-top: 0;">Nomination received</p>

    <p>Dear {{ $nomination->contact }},</p>

    <p>Thank you for your nomination. We have received it successfully.</p>

    <table style="border-collapse: collapse; margin: 16px 0;">
        <tr>
            <td style="padding: 8px 16px 8px 0; color: #666;">Reference number</td>
            <td style="padding: 8px 0; font-weight: bold; font-size: 18px;">{{ $nomination->reference_id }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 16px 8px 0; color: #666;">Nominee</td>
            <td style="padding: 8px 0;">{{ $nomination->nominee_name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 16px 8px 0; color: #666;">Company</td>
            <td style="padding: 8px 0;">{{ $nomination->company }}</td>
        </tr>
        <tr>
            <td style="padding: 8px 16px 8px 0; color: #666;">Category</td>
            <td style="padding: 8px 0;">{{ $nomination->category }}</td>
        </tr>
    </table>

    <p>Please keep your reference number safe — you will need it for any future correspondence about this nomination.</p>

    <p style="color: #666; font-size: 13px;">This is an automated message, please do not reply.</p>
</body>
</html>
