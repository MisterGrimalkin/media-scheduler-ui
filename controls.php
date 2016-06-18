<!DOCTYPE html>
<html>
<?php
    include("includes/header.html"); 
    include("includes/common.php");
    include("includes/wrapper.php");
    echo wrap("script", [], "url = '".URL."';");
?>
    <body onload="selectTab('tabControls');">
        <div class="content">
            <h2>Quick Fire</h2>
            <div style="margin: 10px;">
                <button type="button" onclick="fireLogo();">Greenpeace Logo</button>
                <button type="button" onclick="fireScroller();">Scrolling Message</button>
            </div>
            <br>
            <h2>Small Signs</h2>
            <div style="margin: 10px;">
                <button type="button" onclick="activateShowers();">Shower Mode</button>
                <button type="button" onclick="activateEvents();">Events Mode</button>
            </div>
            <br>
        </div>
        
    </body>
</html>