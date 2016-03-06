<div class="controlPanel">
    <p>
        <div class="fieldLabel">Brightness</div>
        <input id="brightness" type="range" min="0" max="127"
               value="<?php echo getBrightness(); ?>" onchange="changeBrightness();">
    </p>
    <p>
        <div class="fieldLabel">Contrast</div>
        <input id="contrast" type="range" min="0" max="127"
               value="<?php echo getContrast(); ?>" onchange="changeContrast();">
    </p>
</div>