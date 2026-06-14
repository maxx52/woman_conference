<?php
header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method Not Allowed';
    exit;
}

function field_value(string $name): string
{
    return trim($_POST[$name] ?? '');
}

$name = field_value('name');
$lastName = field_value('lastName');
$birthday = field_value('birthday');
$city = field_value('city');
$church = field_value('church');
$ministry = field_value('ministry');
$email = field_value('email');
$phone = field_value('phone');

$required = [
    'Имя' => $name,
    'Фамилия' => $lastName,
    'Дата рождения' => $birthday,
    'Город' => $city,
    'Церковь' => $church,
    'Служение в церкви' => $ministry,
    'Email' => $email,
    'Телефон' => $phone,
];

foreach ($required as $title => $value) {
    if ($value === '') {
        http_response_code(422);
        echo 'Не заполнено поле: ' . $title;
        exit;
    }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo 'Некорректный email';
    exit;
}

$to = 'admin@krepost-krasota.ru';
$subject = 'Регистрация нового участника';

$message = "Новая регистрация на женскую конференцию\n\n";
$message .= "Имя: {$name}\n";
$message .= "Фамилия: {$lastName}\n";
$message .= "Дата рождения: {$birthday}\n";
$message .= "Город: {$city}\n";
$message .= "Церковь: {$church}\n";
$message .= "Служение в церкви: {$ministry}\n";
$message .= "Email: {$email}\n";
$message .= "Телефон: {$phone}\n";

$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: text/plain; charset=utf-8';
$headers[] = 'From: site@krepost-krasota.ru';
$headers[] = 'Reply-To: ' . $email;

$sent = mail($to, $subject, $message, implode("\r\n", $headers));

if (!$sent) {
    http_response_code(500);
    echo 'Ошибка отправки письма';
    exit;
}

echo 'OK';
