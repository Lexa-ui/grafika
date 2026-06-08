<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(strip_tags($_POST["name"] ?? ""));
    $email   = htmlspecialchars(strip_tags($_POST["email"] ?? ""));
    $subject = htmlspecialchars(strip_tags($_POST["subject"] ?? ""));
    $message = htmlspecialchars(strip_tags($_POST["message"] ?? ""));

    $to      = "contact@lexadesign.hu";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Új üzenet érkezett a lexadesign.hu weboldalról!\n\n";
    $body .= "Név: $name\n";
    $body .= "E-mail: $email\n";
    $body .= "Téma: $subject\n\n";
    $body .= "Üzenet:\n$message\n";

    if (mail($to, "Új üzenet: " . $subject, $body, $headers)) {
        echo json_encode(["status" => "ok"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} else {
    http_response_code(403);
}
?>
