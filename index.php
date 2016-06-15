<!DOCTYPE html>
<?php $date=filter_input(INPUT_GET, "date") ? filter_input(INPUT_GET, "date") : date("Y-m-d"); ?>

<html>

<?php include("includes/header.html"); ?>

<body onload="onLoad();">

<div id="mask" class="maskoff"></div>

<?php
    include("includes/common.php");
    include("includes/wrapper.php");
    include("forms/showTimeForm.php");
    echo wrap("script", [], "url = '".URL."';");
    $navlinks = [];
            
?>

<div class="topBar">
    <h1>Media Scheduler</h1>
</div>

<nav class="tabBar">
    <a id="tabShowTimes" href="show-times.php" target="mainContent">Show Times</a>
    <a id="tabMessages" href="messages.php" target="mainContent">Messages</a>
    <a id="tabTickets" href="tickets.php" target="mainContent">Tickets</a>
</nav>

<iframe id="mainContent" name="mainContent" width="1300" height="1000" src="" frameborder="0"></iframe>




</body>

</html>