<!DOCTYPE html>
<html>
    <?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
    $femaleTicket = get("/showers/female");
    $maleTicket = get("/showers/male");
    echo wrap("script", [], "url = 'http://192.168.1.72:8001/scheduler'; male = '$maleTicket'; female = '$femaleTicket';");
    ?>
    <body onload="selectTab('tabTickets'); monitorShowers();">
        <div id="ticketBody" >
        <div style="text-align: center">
            <img src="images/gplogo.jpg" style="margin:20px;"/>
        </div>
        <div class="ticketContent">
            <div class="showerButton" onclick="setTicketNumber('female', <?php echo $femaleTicket ?>);">
                FEMALE
                <p id="femaleTicketNumber" class="ticketNumber">
                    <?php echo $femaleTicket ?>
                </p>
            </div>
            <div class="showerButton" onclick="setTicketNumber('male', <?php echo $maleTicket ?>);">
                MALE
                <p id="maleTicketNumber" class="ticketNumber">
                    <?php echo $maleTicket ?>
                </p>
            </div>
            <br>
            <div class="showerControl" onclick="nextTicketNumber('female');">
                Next
            </div>
            <div class="showerControl" onclick="nextTicketNumber('male');">
                Next
            </div>
        </div>
        </div>

    </body>
</html>