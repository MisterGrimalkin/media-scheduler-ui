<!DOCTYPE html>
<html>
    <?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
    echo wrap("script", [], "url = '" . URL . "';");
    ?>
    <body onload="selectTab('tabTickets');">
        <div class="content">
            <h2>Tickets</h2>
        </div>

    </body>
</html>