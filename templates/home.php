<?php
include __DIR__ . "/partials/header.part.php";
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
            <div style="display: flex; width: 500px; margin: 0 0 0 auto">
                <div id="heroine-chart"></div>
            </div>
            <p class="text-small" style="color: var(--white); text-align:end; font-size: 0.75rem"><em><?= $i18n["heroine-chartlegend"] ?></em></p>
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