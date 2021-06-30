<?php
header('Content-Type: application/json');
global $lang;
global $conn;
global $i18n;

$uuid = $_POST["uuid"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
if ($_POST["phone"] != "") {
    $phone = $_POST["phone"];
} else {
    $phone = "";
}
$insurance = $_POST["insurance"];
if (isset($_POST["insured"])) {
    $insured = 1;
} else {
    $insured = 0;
}

if (isset($_POST["privacy"])) {
    $privacy = 1;
} else {
    $privacy = 0;
}

if ($insurance != "insc-6") {
    $sql = "SELECT COUNT(*) as numrows from `emails` WHERE `email_email` = ? && `email_insurance` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $insurance);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    
    if ($result["numrows"] != 0) {
        $return = array(
            "code" => 505,
            "type" => "danger",
            "message" => $i18n["e-505"]
        );
    
        echo(json_encode($return));
        exit;
    }
}



$sql = "INSERT into `emails` (`email_UUID`, `email_fname`, `email_lname`, `email_email`, `email_phone`, `email_insurance`, `email_insured`, `email_optin`) VALUES (?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `email_UUID`=`email_UUID`;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $uuid, $fname, $lname, $email, $phone, $insurance, $insured, $privacy);
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

$email_subject = $i18n["email-subject"] . " ({$uuid})";
$tags = array("[fname]", "[lname]", "[insurance]");
$replace = array($fname, $lname, $i18n["misc-insurances"][$insurance]["name"]);
if ($insured == 1) {
    $email_content = str_replace($tags, $replace, $i18n["email-content-insured"]);
} else {
    $email_content = str_replace($tags, $replace, $i18n["email-content"]);
}

$return = array(
    "code" => 200,
    "type" => "success",
    "uuid" => $uuid,
    "emailSubject" => $email_subject,
    "emailContent" => $email_content,
    "onclick" => "_paq.push(['trackEvent', 'EmailCampaign', 'Sent', '{$insurance}']);"
);
echo(json_encode($return));
exit;

?>