<!DOCTYPE html>
<html>
<?php
    include("includes/header.html"); 
    include("includes/common.php");
    include("includes/wrapper.php");
    echo wrap("script", [], "url = '".URL."';");
?>
    <body onload="selectTab('tabMessages');">
        <div class="content">
            <h2>Messages</h2>
        </div>
        
    </body>
</html>