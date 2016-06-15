<div id="showTimeForm" class="form showTime">

    <form method="POST" action="actions/saveShowTime.php">

        <h3 id="showTimeFormHeader">Create Show</h3>

        <input id="showTimeHiddenId" type="number" name="id" class="hidden">
        <p>
            <label for="showTimeFormDate" class="fieldLabel">Date</label>
            <input id="showTimeFormDate" type="date" name="date" class="field saveOnChange" style="width: 210px;">
        </p>

        <p>
            <label for="showTimeFormStartTime" class="fieldLabel">Start</label>
            <input id="showTimeFormStartTime" type="time" name="startTime"  class="field saveOnChange" style="width: 80px;">
            <label for="showTimeFormEndTime" class="fieldLabel">End</label>
            <input id="showTimeFormEndTime" type="time" name="endTime"  class="field saveOnChange" style="width: 80px;">
        </p>
        <p>
            <label for="showTimeFormTitle" class="fieldLabel">Title</label>
            <input id="showTimeFormTitle" type="text" name="title" class="field saveOnChange" style="width: 250px;">
        </p>
        <p>
            <label for="showTimeFormDescription1" class="fieldLabel">Line 1</label>
            <input id="showTimeFormDescription1" type="text" name="description1" class="field saveOnChange" style="width: 380px;">
        </p>
        <p>
            <label for="showTimeFormDescription2" class="fieldLabel">Line 2</label>
            <input id="showTimeFormDescription2" type="text" name="description2" class="field saveOnChange" style="width: 380px;">
        </p>
        <p>
            <label for="showTimeFormAlwaysShow" class="fieldLabel" style="width: 100px;">Always Show</label>
            <input id="showTimeFormAlwaysShow" type="checkbox" name="alwaysShow" class="field saveOnChange" style="width: 30px;">
            <label for="showTimeFormAlwaysShowOnDay" class="fieldLabel" style="width: 100px;">Show On Day</label>
            <input id="showTimeFormAlwaysShowOnDay" type="checkbox" name="alwaysShowOnDay" class="field saveOnChange" style="width: 30px;">
        </p>
        
        <p style="text-align: center">
            <button type="submit">Save</button>
            <button type="button" onclick="hideShowTimeForm(document);">Cancel</button>
        </p>

    </form>

</div>