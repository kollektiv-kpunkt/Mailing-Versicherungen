<?php
header('Content-Type: application/json');
global $lang;
global $conn;
global $i18n;
global $config;

$uuid = $_POST["uuid"];
$subject = $_POST["subject"];
$email = $_POST["email"];

if (strlen($email) > 1000) {
    $return = array(
        "code" => 500.1,
        "type" => "error",
        "message" => $i18n["e-500.1"]
    );
    echo(json_encode($return));
    exit;
}

$sql = "UPDATE `emails` SET `email_subject` = ?, `email_content` = ? WHERE `email_UUID` = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $subject, $email, $uuid);
$result = $stmt->execute();

if ($result != 1) {
    $return = array(
        "code" => 500,
        "type" => "error",
        "message" => $i18n["e-500"]
    );
    echo(json_encode($return));
    exit;
}

$sql = "SELECT * from `emails` WHERE `email_UUID` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uuid);
$stmt->execute();
$emaildata = $stmt->get_result()->fetch_assoc();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $config["email-host"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config["email-user"];
    $mail->Password   = $config["email-password"];
    $mail->Port       = $config["email-port"];

    //Recipients
    $mail->setFrom($config["email-user"], "Timothy Oesch");
    $mail->addAddress('timothy.oesch@gmail.com', 'Joe User');

    //Content
    $mail->isHTML(true);
    $mail->Subject = $emaildata["email_subject"];
    $mail->Body    = nl2br($emaildata["email_content"]);

    // $result = $mail->send();
    $result = 1;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

if ($result != 1) {
    $return = array(
        "code" => 500,
        "type" => "error",
        "message" => $i18n["e-500"]
    );
    echo(json_encode($return));
    exit;
}

$sql = "UPDATE `emails` SET `email_sent`=1 WHERE `email_UUID`=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $uuid);
$result = $stmt->execute();

if ($result != 1) {
    $return = array(
        "code" => 500,
        "type" => "error",
        "message" => $i18n["e-500"]
    );
    echo(json_encode($return));
    exit;
}

$return = array(
    "code" => 200,
    "type" => "success",
    "uuid" => $uuid,
    "thxTitle" => str_replace("[fname]", $emaildata["email_fname"], $i18n["email-thx-title"])
);
echo(json_encode($return));