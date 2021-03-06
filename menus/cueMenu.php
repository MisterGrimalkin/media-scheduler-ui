<nav>
    <h3>Cues</h3>

    <?php

        $cues = getCues();

        if ( count($cues)===0 ) {

            echo wrap("div", ["class"=>"offline"], "No Cues");

        } else {

            asort($cues);

            foreach ( $cues as $cue ) {
                $id = $cue["id"];
                $name = $cue["name"];

                echo wrap("button", ["type"=>"button","class"=>"eventOnCue$id", "onclick"=>"highlightEvents(\"$id\", false);"],
                        "Cue $id: $name", true, false) . "<br>";
            }

        }

        echo "<br>". wrap("button", ["type"=>"button", "onclick"=>"showCueForm(document);"], "Add...");
        echo "<br>". wrap("button", ["type"=>"button", "onclick"=>"editSelectedCue();"], "Edit");

    ?>

</nav>
