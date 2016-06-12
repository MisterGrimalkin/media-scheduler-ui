<div class="controlPanel">
    <p>
        <label for="brightness" class="fieldLabel">Brightness</label>
        <input id="brightness" type="range" min="0" max="127"
               value="<?php echo getBrightness(); ?>" onchange="changeBrightness();">
    </p>
    <p>
        <label for="contrast" class="fieldLabel">Contrast</label>
        <input id="contrast" type="range" min="0" max="127"
               value="<?php echo getContrast(); ?>" onchange="changeContrast();">
    </p>
</div>