<div id="cueForm" class="form cue">

    <form method="POST" action="actions/createCue.php">

        <h3>Create Cue</h3>

        <input id="cueFormHiddenDate" type="date" name="reloadDate" class="hidden" value="<?php echo $date; ?>">

        <p>
            <div class="fieldLabel">Number</div>
            <input id="cueFormNumber" type="text" name="cueNumber" class="field saveOnChange" style="width: 50px;">
        </p>

        <p>
            <div class="fieldLabel">Name</div>
            <input id="cueFormName" type="text" name="cueName" class="field saveOnChange">
        </p>

        <p style="text-align: center">
            <button type="submit">Create</button>
            <button type="button" onclick="hideCueForm();">Cancel</button>
        </p>

    </form>

</div>