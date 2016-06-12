var url;

function onLoad() {
    
    restoreFormValuesFromSession();

    loadSchedule();

    $("#eventForm").draggable();
    $("#cueForm").draggable();

    $(".saveOnChange").change(function() {
        saveFormValuesToSession();
    });
    
    setInterval(function() {
        if ( !timePaused ) {
            updateTime();
        }
    }, 250);

    setInterval(function() {
        if ( !offline ) {
            updateTimeCursor();
        }
    }, 100);
    
}

function loadSchedule() {
    var w = window.innerWidth - 240;
    var h = Math.max(window.innerHeight - 150, parseInt($("#sideBar").css("height")));
    $("#schedule")
        .attr("width", w+20)
        .attr("height", window.innerHeight - 130)
        .attr("src", "viewSchedule.php?date="+$("#searchDate").val()+"&width="+w+"&height="+h);
}

////////////
// Events //
////////////

function addEvent() {
    selectEvent(0, false);
    $("#eventHiddenId").val(-1);
    if ( sessionStorage.getItem("highlightCueId") > 0 ) {
        $("#eventCueId").val(sessionStorage.getItem("highlightCueId"));
    }
    highlightEvents(0, false);
    showEventForm(document);
}

function editSelectedEvent() {
    editEvent(sessionStorage.getItem("selectedEventId"), document);
}

function editEvent(id, context) {
    $.ajax({
        url: url+"/schedule/event",
        type: 'GET',
        data: {
            id: ""+id
        },
        success: function(response) {
            var event = JSON.parse(response);
            showEventForm(context);
            $("#eventFormHeader", context).html("Edit Event");
            $("#eventHiddenId", context).val(event["id"]);
            $("#eventFormDate", context).val(event["startDate"]);
            $("#eventFormStartTime", context).val(event["startTime"]);
            $("#eventFormEndTime", context).val(event["endTime"]);
            $("#eventCueId", context).val(event["cueId"]);
            $("#eventFormOK", context).html("Update");
            $("#eventFormStartDate", context).focus();
        },
        fail: function(response) {
            window.alert(response);
        }
    });

}

function removeEvent() {
    var selected = sessionStorage.getItem("selectedEventId");
    var response = window.confirm("Really delete this event?");
    if ( response ) {
        if ( selected >= 0 ) {
            $.ajax({
                url: 'actions/removeEvent.php',
                type: 'POST',
                data: ""+selected,
                success: function(response) {
                    location.reload();
                },
                fail: function(response) {
                    window.alert(response);
                }
            });
        }
    }
}

function selectEvent(id, fromFrame) {
    var selected = sessionStorage.getItem("selectedEventId");
    if ( selected ) {
        if ( fromFrame ) {
            $(".event"+selected).css("background-color", "");
            $("#removeEvent", parent.document).prop("disabled", "disabled");
            $("#editEvent", parent.document).prop("disabled", "disabled");
        } else {
            $("#schedule").contents().find(".event"+selected).css("background-color", "");
            $("#removeEvent").prop("disabled", "disabled");
            $("#editEvent").prop("disabled", "disabled");
        }
    }
    if ( id > 0 ) {
        highlightEvents(0, fromFrame);
        if ( fromFrame ) {
            $(".event"+id).css("background-color", "red");
            $("#removeEvent", parent.document).prop("disabled", "");
            $("#editEvent", parent.document).prop("disabled", "");
        } else {
            $("#schedule").contents().find(".event"+id).css("background-color", "red");
            $("#removeEvent").prop("disabled", "");
            $("#editEvent").prop("disabled", "");
        }
    }
    sessionStorage.setItem("selectedEventId", id);
}

function highlightEvents(cueId, fromFrame) {
    selectEvent(0);
    var highlighted = sessionStorage.getItem("highlightCueId");
    if ( highlighted ) {
        if ( fromFrame ) {
            $(".eventOnCue"+highlighted, parent.document).css("background-color", "");
            $(".eventOnCue"+highlighted)
                    .css("background-color", "")
                    .css("color", "");
        } else {
            $(".eventOnCue"+highlighted).css("background-color", "");
            $("#schedule").contents().find(".eventOnCue"+highlighted)
                .css("background-color", "")
                .css("color", "");
        }
    }
    if ( cueId > 0 ) {
        if ( highlighted===cueId ) {
            highlighted = 0;
        } else {
            if ( fromFrame ) {
                $(".eventOnCue"+cueId, parent.document).css("background-color", "yellow");
                $(".eventOnCue"+cueId)
                        .css("background-color", "yellow")
                        .css("color", "black");
            } else {
                $(".eventOnCue"+cueId).css("background-color", "yellow");
                $("#schedule").contents().find(".eventOnCue"+cueId)
                    .css("background-color", "yellow")
                    .css("color", "black");
            }
        }
    }
    sessionStorage.setItem("highlightCueId", cueId);
}

function editCue(id, context) {
    console.log(url);
    $.ajax({
        url: url+"/cue?id="+id,
        type: 'GET',
        success: function(response) {
            var cue = JSON.parse(response);
            var hostStr = "";
            var hosts = cue["hosts"];
            if ( hosts ) {
                for ( var i=0; i<hosts.length; i++ ) {
                    if ( i>0 ) {
                        hostStr += ";;";
                    }
                    hostStr += hosts[i]["ip"];
                }
            }
            var paramStr = "";
            var params = cue["params"];
            if ( params ) {
                for ( var i=0; i<params.length; i++ ) {
                    if ( i>0 ) {
                        paramStr += ";;";
                    }
                    paramStr += params[i]["name"]+"="+params[i]["value"];
                }
            }
            showCueForm(context);
            $("#cueFormHeader", context).html("Edit Cue");
            $("#cueHiddenId", context).val(cue["id"]);
            $("#cueFormName", context).val(cue["name"]);
            $("#cueFormMethod", context).val(cue["method"]);
            $("#cueFormHosts", context).val(hostStr);
            $("#cueFormPath", context).val(cue["path"]);
            $("#cueFormParams", context).val(paramStr);
            $("#cueFormPayload", context).val(cue["payload"]);
            $("#cueFormOK", context).html("Update");
            $("#cueFormName", context).focus();
        },
        fail: function(response) {
            window.alert(response);
        }
    });
}

function editSelectedCue() {
    var selectedCue = sessionStorage.getItem("highlightCueId");
    if ( selectedCue ) {
        editCue(selectedCue, document);
    }
}

//////////
// Time //
//////////

var offline = false;
var timePaused = false;

function updateTime() {
    var rq = $.get(url + "/schedule/time");
    rq.done(function(response) {
        $("#timePanel")
            .attr("class", "timePanel")
            .html(response.substr(0,8));
        if ( offline ) {
            timePaused = true;
            location.reload();
        }
    })
    .fail(function(err) {
        $("#timePanel")
            .attr("class", "timePanel offline")
            .html("Offline");
        if ( !offline ) {
            mask(true);
            $("#schedule").contents().find("#nowMarker").css("opacity",0);
        }
        offline = true;
    });
}

var cursorOpacity = 0;
var cursorOpacityDelta = 0.2;

function updateTimeCursor() {
    $("#schedule").contents().find("#nowMarker").css("opacity",cursorOpacity);
    cursorOpacity += cursorOpacityDelta;
    if ( cursorOpacity >= 1 ) {
        cursorOpacity = 1;
        cursorOpacityDelta = -cursorOpacityDelta;
    }
    if ( cursorOpacity <= 0 ) {
        cursorOpacity = 0;
        cursorOpacityDelta = -cursorOpacityDelta;
    }
}

//////////
// Date //
//////////

function dateString(date) {
    return date.getFullYear() + "-" + ("0"+(date.getMonth()+1)).slice(-2) + "-" + ("0"+date.getDate()).slice(-2);
}

function redirect(target) {
    window.location.assign(target);
}

function today() {
    mask(true);
    redirect("index.php?date="+dateString(new Date()));
}

function moveDays(days) {
    var date = new Date($("#searchDate").val());
    date = new Date(date.getTime() + (days*24*60*60*1000))
    mask(true);
    redirect("index.php?date="+dateString(date));
}


///////////
// Forms //
///////////

function showCueForm(context) {
    mask(true);
    $("#cueForm", context).attr("class", "form shown cue");
    $("#cueFormNumber", context)
        .focus()
        .select();
}

function showEventForm(context) {
    mask(true, context);
    $("#eventFormHeader", context).html("Create Event");
    $("#eventForm", context).attr("class", "form shown editEvent");
    $("#eventFormOK", context).html("Create");
    if ( !sessionStorage.getItem("eventFormDate") ) {
        $("#eventFormDate", context).val($("#searchDate").val());
    }
    $("#eventFormStartTime", context).focus();
}

function hideCueForm() {
    $("#cueForm").attr("class", "form cue");
    mask(false);
}

function hideEventForm() {
    $("#eventForm").attr("class", "form editEvent");
    mask(false);
}

function mask(on) {
    mask(on, document);
}

function mask(on, context) {
    $("#mask", context).attr("class", "mask"+(on?"on":"off"));
}


/////////////////
// Form Values //
/////////////////

function saveFormValuesToSession() {
    saveFormValue("eventFormDate");
    saveFormValue("eventFormStartTime");
    saveFormValue("eventFormEndTime");
    saveFormValue("eventCueId");
    saveFormValue("cueFormNumber");
    saveFormValue("cueFormName");
}

function saveFormValue(valueName) {
    sessionStorage.setItem(valueName, $("#"+valueName).val());
}

function restoreFormValuesFromSession() {
    restoreFormValue("eventFormDate");
    restoreFormValue("eventFormStartTime");
    restoreFormValue("eventFormEndTime");
    restoreFormValue("eventCueId");
    restoreFormValue("cueFormNumber");
    restoreFormValue("cueFormName");
}

function restoreFormValue(valueName) {
    $("#"+valueName).val(sessionStorage.getItem(valueName));
}


////////////////////
// Image Controls //
////////////////////

function changeBrightness() {
    var val = $("#brightness").val();
    var rq = $.post(url + "/control/brightness?value="+val)
    .fail(function(err) {
        window.alert("Error setting brightness: " + err);
    });
}

function changeContrast() {
    var val = $("#contrast").val();
    var rq = $.post(url + "/control/contrast?value="+val)
    .fail(function(err) {
        window.alert("Error setting contrast: " + err);
    });
}
