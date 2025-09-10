<?php
// UWAGA: brak spacji/znaków przed tym tagiem!

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ustawienia UTF-8
    mb_internal_encoding('UTF-8');

    $name    = isset($_POST['name'])    ? trim($_POST['name'])    : '';
    $email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Prosta walidacja
    if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "<h2 style='font-family:sans-serif;color:red;text-align:center;margin-top:50px;'>❌ Nieprawidłowe dane formularza.</h2>";
        echo "<p style='text-align:center;'><a href='index.html'>⏪ Wróć i popraw</a></p>";
        exit;
    }

    // Dokąd wysyłamy
    $to      = 'fotobudka.flashzone@gmail.com';
    $subject = 'Nowa wiadomość z formularza fotobudki';

    // Treść wiadomości (tekst)
    $body = "Imię i nazwisko: {$name}\n"
          . "Email: {$email}\n\n"
          . "Wiadomość:\n{$message}\n";

    // Nagłówki (UTF-8 + reply-to)
    // W wielu hostingach lepiej, by 'From' był z Twojej domeny (np. no-reply@twojadomena.pl)
    $fromDomain = 'no-reply@' . ($_SERVER['HTTP_HOST'] ?? 'twojadomena.pl');
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "From: {$fromDomain}\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    if (mail($to, $subject, $body, $headers)) {
        // Redirect po sukcesie – musi być przed jakimkolwiek outputem!
        header('Location: thankyou.html');
        exit;
    } else {
        http_response_code(500);
        echo "<h2 style='font-family:sans-serif;color:red;text-align:center;margin-top:50px;'>❌ Wystąpił problem podczas wysyłania.</h2>";
        echo "<p style='text-align:center;'><a href='index.html'>⏪ Spróbuj ponownie</a></p>";
        exit;
    }
}
