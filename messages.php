<!DOCTYPE html>
<html>
<?php
    include("includes/header.html"); 
    include("includes/common.php");
    include("includes/wrapper.php");
    echo wrap("script", [], "url = 'http://192.168.30.77:8001/scheduler';");
?>
    <body onload="selectTab('tabMessages');">
        <div class="content">
            <h2>Shower Messages</h2>
            <?php
                $messages = getShowerMessages();
                if ( $messages ) {
                    foreach ( $messages as $id=>$message ) {
                        echo wrap("div", ["class"=>"messageLine"], 
                            wrap("input", ["id"=>"showerMessage-$id", "type"=>"text", "maxlength"=>"50", "value"=>$message], "") .
                            wrap("button", ["type"=>"button", "onclick"=>"saveShowerMessage($id);"], "Save") .
                            wrap("button", ["type"=>"button", "onclick"=>"removeShowerMessage($id);"], "Remove")
                        );
                        echo "<br>";
                    }
                }
                echo wrap("div", ["class"=>"messageLine"], 
                    wrap("input", ["id"=>"showerMessage-add", "type"=>"text", "maxlength"=>"50"], "") .
                    wrap("button", ["type"=>"button", "onclick"=>"addShowerMessage();"], "Add")
                );
            ?>
            <br>
            <h2>Scrolling Messages</h2>
            <?php
                $scrollMessages = getScrollerMessages();
                if ( $scrollMessages ) {
                    foreach ( $scrollMessages as $id=>$message ) {
                        echo wrap("div", ["class"=>"messageLine"], 
                            wrap("input", ["id"=>"scrollerMessage-$id", "type"=>"text", "maxlength"=>"50", "value"=>$message], "") .
                            wrap("button", ["type"=>"button", "onclick"=>"saveScrollerMessage($id);"], "Save") .
                            wrap("button", ["type"=>"button", "onclick"=>"removeScrollerMessage($id);"], "Remove")
                        );
                        echo "<br>";
                    }
                }
                echo wrap("div", ["class"=>"messageLine"], 
                    wrap("input", ["id"=>"scrollerMessage-add", "type"=>"text", "maxlength"=>"50"], "") .
                    wrap("button", ["type"=>"button", "onclick"=>"addScrollerMessage();"], "Add")
                );
            ?>
            <br>
        </div>
        
    </body>
</html>