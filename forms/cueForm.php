<div id="cueForm" class="form cue">

    <form method="POST" action="actions/createCue.php">

        <h3 id="cueFormHeader">Create Cue</h3>

        <input id="cueFormHiddenDate" type="date" name="reloadDate" class="hidden" value="<?php echo $date; ?>">
        <input id="cueHiddenId" type="number" name="id" class="hidden">

        <p>
            <label for="cueFormName" class="fieldLabel">Name</label>
            <input id="cueFormName" type="text" name="cueName" class="field saveOnChange" style="width: 350px;">
        </p>
        
        <p>
            <label for="cueFormHosts" class="fieldLabel">Hosts</label>
            <input id="cueFormHosts" type="text" name="cueHosts" class="field saveOnChange" style="width: 350px;">
        </p>
        
        <p>
            <label for="cueFormMethod" class="fieldLabel">Method</label>
            <input id="cueFormMethod" type="text" name="cueMethod" class="field saveOnChange" style="width: 350px;">
        </p>
        
        <p>
            <label for="cueFormPath" class="fieldLabel">Path</label>
            <input id="cueFormPath" type="text" name="cuePath" class="field saveOnChange" style="width: 350px;">
        </p>
        
        <p>
            <label for="cueFormParams" class="fieldLabel">Params</label>
            <input id="cueFormParams" type="text" name="cueParams" class="field saveOnChange" style="width: 350px;">
        </p>
        
        <p>
            <label for="cueFormPayload" class="fieldLabel">Payload</label>
            <input id="cueFormPayload" type="text" name="cuePayload" class="field saveOnChange" style="width: 350px;">
        </p>
        
        

        <p style="text-align: center">
            <button type="submit">Create</button>
            <button type="button" onclick="hideCueForm(document);">Cancel</button>
        </p>

    </form>

</div>