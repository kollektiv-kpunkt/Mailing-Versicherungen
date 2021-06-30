<?php
include __DIR__ . "/partials/header.part.php";

global $conn;

$sql = "SELECT COUNT(email_UUID) as number FROM `emails`;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result["number"] <= 12) {
    $result["number"] = 12;
}

$needle = "[number]";
$haystack = $result["number"];
$counter = str_replace($needle, $haystack, $i18n["misc-counter"]);

?>



<div id="heroine">
    <div id="heroine-cont" class="mdcont">
        <div id="heroine-text" class="heroine-half">
            <p id="heroine-overtitle"><?= $i18n["heroine-overtitle"] ?></p>
            <h1 id="heroine-title"><?= $i18n["heroine-title"] ?></h1>
            <?= $i18n["heroine-content"] ?>
            <div class="buttongrid">
                <a href="#<?= $i18n["s-participate"] ?>" class="button neg"><?= $i18n["b-participate"] ?></a>
                <a href="#<?= $i18n["s-more-info"] ?>" class="button"><?= $i18n["b-more-info"] ?></a>
            </div>
        </div>
        <div id="heroine-graph" class="heroine-half">
            <div id="heroine-chart-cont" style="display: flex; max-width: 500px;">
                <div id="heroine-chart"></div>
            </div>
            <p class="text-small" id="heroine-chartlegend"><em><?= $i18n["heroine-chartlegend"] ?></em></p>
        </div>
    </div>
</div>

<div id="<?= $i18n["s-participate"] ?>" class="section">
    <div class="section-cont smcont">
        <h2 class="section-title"><?= $i18n["participate-title"] ?></h2>
        <p class="section-content"><?= $i18n["participate-content"] ?></p>
        <div class="alert-container" style="display: none;">
            <p id="form-alert">This is an alert message!</p>
        </div>
        <form data-interface="step1" data-step="1" class="ajax-form form-step">
            <input type="text" placeholder="<?= $i18n["misc-fname"] ?>" name="fname" required>
            <input type="text" placeholder="<?= $i18n["misc-lname"] ?>" name="lname" required>
            <input type="email" placeholder="<?= $i18n["misc-email"] ?>" name="email" required>
            <input type="text" placeholder="<?= $i18n["misc-phone"] ?>" name="phone">
            <select class="nobottom" name="insurance" required>
                <option value="" selected disabled><?= $i18n["misc-choose"] ?></option>
                <?php
                $i = 1;
                foreach ($i18n["misc-insurances"] as $insurance) {
                    echo("<option value='insc-{$i}'>{$insurance['name']}</option>");
                    $i++;
                }
                if ($config["test-mode"] == TRUE) {
                    echo("<option value='insc-test'>{$i18n["misc-insurances"]["insc-test"]['name']}</option>");
                }
                ?>
            </select>
            <button type="submit" class="button"><?= $i18n["b-next"] ?></button>
            <div class="chk-group">
                <input type="checkbox" id="insured" name="insured" value="1">
                <label for="insured"><?= $i18n["misc-insured"] ?></label>
            </div>
            <div class="chk-group">
                <input type="checkbox" id="privacy" name="privacy" value="1" checked>
                <label for="privacy"><?= $i18n["misc-privacy"] ?></label>
            </div>
            <input type="hidden" name="uuid" value="<?= uniqid("email_") ?>">
        </form>
        <form data-interface="step2" data-step="2" class="ajax-form form-step" style="display: none;">
            <input type="text" class="fullwidth" name="subject" placeholder="<?= $i18n["misc-subject"] ?>" id="subject" required>
            <textarea name="email" id="email" class="fullwidth" rows="8" placeholder="<?= $i18n["misc-mailcontent"] ?>" required></textarea>
            <input type="hidden" name="uuid" id="uuid-2">
            <button type="submit" class="button" onclick=""><?= $i18n["b-next"] ?></button>
        </form>
        <form data-interface="step3" data-step="3" class="ajax-form form-step" style="display: none;">
            <h4 style="color: var(--red)" id="thx-title"></h4>
            <p id="thx-content"><?= $i18n["email-thx-content"] ?></p>
            <div class="buttongrid one">
                <?php
                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
                ?>
                <a href="<?= "https://api.whatsapp.com/send?text=" . urlencode($i18n["mobi-msg"] . "\n" . $actual_link) ?>" class="button" id="WhatsApp"><?= $i18n["wa-text"] ?></a>
                <a href="<?= "https://t.me/share/url?url=" . urlencode($actual_link) . "&text=" . urlencode($i18n["mobi-msg"] . "\n" . $actual_link) ?>" class="button" id="Telegram"><?= $i18n["tele-text"] ?></a>
            </div>
        </form>
        <div id="counter-cont">
            <p style="margin:0"><?= $counter ?></p>
        </div>
    </div>
</div>

<div class="section black" id="<?= $i18n["s-more-info"] ?>">
    <div class="section-cont smcont">
        <h2 class="section-title"><?= $i18n["more-title"] ?></h2>
        <?= $i18n["more-content"] ?>
        <div class="buttongrid">
            <a href="<?= $i18n["s-donate"] ?>" class="button neg"><?= $i18n["b-donate"] ?></a>
            <a href="#<?= $i18n["s-participate"] ?>" class="button"><?= $i18n["b-participate"] ?></a>
        </div>
    </div>
</div>


<script src="/lib/chartist/chartist.min.js"></script>
<script>
    var data = {
        labels: ['Baloise Direct Medium', 'TCS M', 'Helvetia Premium'],
        series: [
            [1669, 1705, 1365],
            [883, 912, 738]
        ]
    };

    var options = {
        high: 1750,
        low: 400,
        seriesBarDistance: 20
    };
    
    new Chartist.Bar('#heroine-chart', data, options);
</script>

<?php
include __DIR__ . "/partials/footer.part.php";
?>