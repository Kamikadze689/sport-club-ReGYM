<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение Email</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:40px;">

<div style="
    max-width:600px;
    margin:0 auto;
    background:#ffffff;
    padding:40px;
    border-radius:12px;
">

    <h2 style="color:#111827;">
        Добро пожаловать в ReGYM!
    </h2>

    <p>
        Благодарим за регистрацию.
    </p>

    <p>
        Для завершения регистрации подтвердите адрес электронной почты.
    </p>

    <div style="margin-top:30px;">
        <a href="{{ $url }}"
           style="
           background:#FFD700;
           color:#000;
           text-decoration:none;
           padding:14px 24px;
           border-radius:8px;
           display:inline-block;
           font-weight:bold;">
            Подтвердить Email
        </a>
    </div>

    <p style="margin-top:30px;color:#666;">
        Если вы не регистрировались на сайте ReGYM,
        просто проигнорируйте это письмо.
    </p>

</div>

</body>
</html>