<!DOCTYPE html>
<?php $date=filter_input(INPUT_GET, "date") ? filter_input(INPUT_GET, "date") : date("Y-m-d"); ?>

<html>

<?php include("includes/header.html"); ?>

<body onload="onLoad();">

<div id="mask" class="maskoff"></div>

<div id="selectedEventId" data-value="-1" class="hidden"></div>

<div id="timePanel" class="timePanel"></div>

<?php
    include("includes/common.php");
    include("includes/wrapper.php");
    include("forms/cueForm.php");
    include("forms/eventForm.php");
    echo wrap("script", [], "url = '".URL."';");
?>

<div id="sideBar" class="cueMenu">
    <?php
        include("menus/eventMenu.php");
        include("menus/cueMenu.php");
    ?>
</div>

<div class="schedulePanel">
    <?php
        include("forms/searchDateForm.php");
    ?>
    <iframe id="schedule" width="1000" height="820" frameborder="0"></iframe>
</div>

</body>

</html>