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

<script src="/js/script.js"></script>
</div>
</body>
</html>