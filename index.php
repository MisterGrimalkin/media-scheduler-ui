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
    <img src="images/gplogo.jpg" style="margin:20px; float:right;"/>
    <h1>Glastonbury 2016</h1>
</div>

<nav class="tabBar">
    <a id="tabShowTimes" href="show-times.php" target="mainContent">Show Times</a>
    <a id="tabMessages" href="messages.php" target="mainContent">Messages</a>
    <a id="tabTickets" href="tickets.php" target="mainContent">Tickets</a>
    <a id="tabControls" href="controls.php" target="mainContent">Controls</a>
</nav>

<iframe id="mainContent" name="mainContent" width="1300" height="1000" src="" frameborder="0"></iframe>




</body>

</html>