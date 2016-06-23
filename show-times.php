<!DOCTYPE html>
<html>
    <?php
    include("includes/header.html");
    include("includes/common.php");
    include("includes/wrapper.php");
    include("forms/showTimeForm.php");
    echo wrap("script", [], "url = 'http://192.168.30.77:8001/scheduler';");
    ?>
    <body onload="selectTab('tabShowTimes'); $('#showTimeForm').draggable();">
        <div class="content">
            <?php
            $shows = getShowTimes();
            echo wrapStart("table");
            echo wrap("tr", [], wrap("td", ["width" => "100"], "<b>Date")
                    . wrap("td", ["width" => "50"], "<b>Start")
                    . wrap("td", ["width" => "50"], "<b>End")
                    . wrap("td", ["width" => "150"], "<b>Title")
                    . wrap("td", ["width" => "200"], "<b>Description 1")
                    . wrap("td", ["width" => "200"], "<b>Description 2")
            );
            foreach ($shows as $show) {
                $id = $show["id"];
                echo wrap("tr", [], wrap("td", ["width" => "100"], $show["date"])
                        . wrap("td", ["width" => "50"], $show["startTime"])
                        . wrap("td", ["width" => "50"], $show["endTime"])
                        . wrap("td", ["width" => "150"], $show["title"])
                        . wrap("td", ["width" => "200"], $show["description1"])
                        . wrap("td", ["width" => "200"], $show["description2"])
                        . wrap("td", [], wrap("button", ["type"=>"button", "onclick"=>"editShow($id)"], "Edit"))
                        . wrap("td", [], wrap("button", ["type"=>"button", "onclick"=>"deleteShow($id)"], "Delete"))
                );
            }
            echo wrapEnd("table");
            echo wrap("button", ["type"=>"button", "onclick"=>"editShow(-1)"], "Add")
            ?>
        </div>

    </body>
</html>