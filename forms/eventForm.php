<div id="eventForm" class="form editEvent">

    <form method="POST" action="actions/createEvent.php">

        <h3 id="eventFormHeader">Create Event</h3>

        <input id="eventFormHiddenDate" type="date" name="reloadDate" class="hidden" value="<?php echo $date; ?>">
        <input id="eventHiddenId" type="number" name="id" class="hidden">

        <p>
            <div class="fieldLabel">Date</div>
            <input id="eventFormDate" type="date" name="startDate" class="field saveOnChange" style="width: 210px;">
        </p>

        <p>
            <div class="fieldLabel">Start</div>
            <input id="eventFormStartTime" type="time" name="startTime"  class="field saveOnChange" style="width: 80px;">
            <div class="fieldLabel">End</div>
            <input id="eventFormEndTime" type="time" name="endTime"  class="field saveOnChange" style="width: 80px;">
        </p>

        <p>
            <div class="fieldLabel">Cue</div>
            <select id="eventCueId" class="field saveOnChange" name="cueId" style="width: 210px;">
                <?php
                    $cues = getCues();
                    if ( count($cues)>0 ) {
                        foreach ( $cues as $cue ) {
                            echo wrap("option", ["value"=>$cue["id"],"class"=>"field"], $cue["name"]);
                        }
                    }
                ?>
            </select>
        </p>

        <p style="text-align: center">
            <button id="eventFormOK" type="submit">OK</button>
            <button type="button" onclick="hideEventForm();">Cancel</button>
        </p>

    </form>

</div>