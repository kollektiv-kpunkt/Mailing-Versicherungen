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
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';

    //Recipients
    $mail->setFrom($config["email-user"], "{$emaildata['email_fname']} {$emaildata['email_lname']}");
    $mail->addAddress($i18n["misc-insurances"][$emaildata["email_insurance"]]["email"], $i18n["misc-insurances"][$emaildata["email_insurance"]]["name"]);
    $mail->addReplyTo($emaildata["email_email"], "{$emaildata['email_fname']} {$emaildata['email_lname']}");

    //Content
    $mail->isHTML(true);
    $mail->Subject = $emaildata["email_subject"];
    $mail->Body    = nl2br($emaildata["email_content"]);

    $result = $mail->send();
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


ob_start();
require __DIR__ . "/email-thx.php";
$email_content = ob_get_clean();

$tags = array("[fname]", "[lname]", "[WA-link]", "[WA-text]", "[Tele-link]", "[Tele-text]", "[donate-text]", "[donate-link]");
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$WAlink = "https://api.whatsapp.com/send?text=" . urlencode($i18n["mobi-msg"] . "\n" . $actual_link);
$Telelink = "https://t.me/share/url?url=" . urlencode($actual_link) . "&text=" . urlencode($i18n["mobi-msg"] . "\n" . $actual_link);
$replace = array($emaildata["email_fname"], $emaildata["email_lname"], $WAlink, $i18n["wa-text"], $Telelink, $i18n["tele-text"], $i18n["donate-text"], "{$actual_link}/{$i18n["s-donate"]}");
$email_content = str_replace($tags, $replace, $email_content);

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $config["email-host"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config["email-user"];
    $mail->Password   = $config["email-password"];
    $mail->Port       = $config["email-port"];
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';

    //Recipients
    $mail->setFrom($config["email-user"], $i18n["sitetitle"]);
    $mail->addAddress($emaildata["email_email"], "{$emaildata['email_fname']} {$emaildata['email_lname']}");

    //Content
    $mail->isHTML(true);
    $mail->Subject = $i18n["emailthx-subject"];
    $mail->Body    = $email_content;

    $result = $mail->send();
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

$sql = "UPDATE `emails` SET `email_sent` = 1 WHERE `email_UUID` = ?;";
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