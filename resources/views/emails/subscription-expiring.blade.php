<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>

<h2>Здравствуйте, {{ $subscription->user->name }}!</h2>

<p>
    Напоминаем, что срок действия вашего абонемента
    <strong>{{ $subscription->type }}</strong>
    заканчивается
    <strong>{{ $subscription->expires_at->format('d.m.Y') }}</strong>.
</p>

<p>
    Продлите абонемент заранее, чтобы сохранить доступ ко всем возможностям клуба.
</p>

<p>
    С уважением,<br>
    Администрация клуба
</p>

</body>
</html>