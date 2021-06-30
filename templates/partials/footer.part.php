<div id="menuDim"></div>

<div id="navmenu-cont">
    <div id="navmenu-inner">
        <div id="navmenu-large">
            <?php
            foreach ($i18n["m-large"] as $item) {
                echo("<a href='{$item['slug']}' class='navitem' target='{$item['target']}'>{$item['title']}</a>");
            }
            ?>
        </div>
        <div id="navmenu-small">
            <?php
            foreach ($i18n["m-small"] as $item) {
                echo("<a href='{$item['slug']}' class='navitem' target='{$item['target']}'>{$item['title']}</a>");
            }
            ?>
            <span id='credits'>Made with ♥ | <a href='https://www.kpunkt.ch' target='_blank'>Webdesign by <b>K.</b></a></span>
        </div>
        <div id="close-icon">Schliessen</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/manucaralmo/GlowCookies@3.1.2/src/glowCookies.min.js"></script>
<script>
    glowCookies.start('en', {
        hideAfterClick: true,
        border: 'none',
        customScript: [{ type: 'src', position: 'head', content: '/js/matomo.js' }],
        policyLink: "/datenschutz",
        bannerDescription: "<?= $i18n["cp-content"] ?>",
        bannerLinkText: "<?= $i18n["cp-more"] ?>",
        bannerBackground: "var(--white)",
        bannerColor: "var(--black)",
        bannerHeading: "<p style='margin-top:0;margin-bottom:0.5em'><b><?= $i18n["cp-title"] ?></b></p>",
        acceptBtnText: "<?= $i18n["cp-b1"] ?>",
        acceptBtnColor: "var(--white)",
        acceptBtnBackground: "var(--black)",
        rejectBtnText: "<?= $i18n["cp-b2"] ?>",
        rejectBtnColor: "var(--red)",
        rejectBtnBackground: "var(--light)",
    });
</script>

<script src="/js/script.js"></script>
</div>
</body>
</html>