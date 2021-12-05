//////////////////////
// Popup Background //
//////////////////////
let meetingAnimalId = '';
let meetingSpeciesId = '';
let meetingChooseDate = '';
let meetingTimeSlotId = '';
let meetingTimeSlotTypeId = '';
let meetingVetoId = '';
let meetingYear = 2020;
let meetingWeek = 1;


let popupBackground = document.createElement("div");
popupBackground.id = "popupBackground";
let st = popupBackground.style;
st.width = '100%';
st.height = '100%';
st.backgroundColor = 'rgba(0,0,0, 0.4)';
st.backdropFilter = 'blur(5px)';
st.position = 'fixed';
st.display = 'flex';
st.justifyContent = 'center';
st.alignItems = 'center';
popupBackground.hidden = true;

///////////
// Popup //
///////////
let popup = document.createElement("div");
popup.id = "popup";
let edSt = popup.style;
edSt.padding = '20px 50px';
edSt.borderRadius = '20px';
edSt.backgroundColor = "#DDDDDD";
edSt.display = 'flex';
edSt.flexDirection = 'column';
edSt.alignItems = 'center';
edSt.gap = '20px';

///////////
// Title //
///////////
let title = document.createElement("span");
title.innerText = "Rendez-Vous";
title.style.fontSize = "28px";

////////////////
// Bottom Div //
////////////////
var actionListDiv = document.createElement("div");
actionListDiv.id = "actionListDiv";
actionListDiv.style.display = "flex";
actionListDiv.style.columnGap = "10px";

///////////////////
// Cancel Button //
///////////////////
var cancelButton = document.createElement("input");
cancelButton.id = "cancelButton"
cancelButton.type = "submit";
cancelButton.className = "button";
cancelButton.value = "Annuler";
cancelButton.style.padding = "12px 25px";
cancelButton.style.fontSize = "18px";
cancelButton.style.backgroundColor = "#C20D0D";
cancelButton.style.transition = "0.2s background-color ease-in-out";
cancelButton.onmouseover = function() {
    this.style.backgroundColor = "#810000";
}

cancelButton.onmouseleave = function(){
    this.style.backgroundColor = "#C20D0D";
}
cancelButton.onclick = function(){
    onExitPopup();
    this.style.backgroundColor = "#c20d0d";
}

/////////////////////////
// Take Meeting Button //
/////////////////////////
let takeMeetingButton = document.createElement("input");
takeMeetingButton.id = "deleteMeetingButton";
takeMeetingButton.type = "submit";
takeMeetingButton.className = "button";
takeMeetingButton.value = "Prendre rendez-vous";
takeMeetingButton.style.padding = "12px 25px";
takeMeetingButton.style.fontSize = "18px";
takeMeetingButton.onclick = function() {
    let ajaxRequest = new AjaxRequest(
        {
            url: "trmt/take_meeting.php",
            method: 'post',
            handleAs: 'json',
            parameters: {
                vetoId: meetingVetoId,
                animalId: meetingAnimalId,
                timeSlotId: meetingTimeSlotId,
                speciesId: meetingSpeciesId,
                chooseDate: meetingChooseDate
            },
            onSuccess: function (res) {
                console.log(res);
            },
            onError: function (status, message) {
            }
        });
}

///////////////
// Functions //
///////////////
appendOriginalElement();
document.onclick = function(e){
    if(e.target.id == 'popupBackground') {
        onExitPopup();
    }
}

function appendOriginalElement() {
    popupBackground.appendChild(popup);

    actionListDiv.appendChild(cancelButton);
    actionListDiv.appendChild(takeMeetingButton);

    popup.appendChild(title);
    popup.appendChild(actionListDiv);

    document.body.appendChild(popupBackground);
}

function onExitPopup() {
    hideEditMeetingPopup();
    clearPopupContainer();
    appendOriginalElement();
    enableScroll();
}

function onOpenPopup(aId, sId, vId, tsId, tstId, y, w) {

    meetingAnimalId = aId;
    meetingSpeciesId = sId;
    meetingVetoId = vId;
    meetingTimeSlotId = tsId;
    console.log(meetingTimeSlotId);
    meetingTimeSlotTypeId = tstId;
    meetingYear = y;
    meetingWeek = w;
    setMeetingChooseDate();

    title.innerText = "Rendez-Vous";
    updatePopup();
    document.getElementById("popupBackground").hidden = false;
    disableScroll();
}

function setMeetingChooseDate(){
    meetingChooseDate = getDateOfISOWeek(meetingWeek, meetingYear);
    new AjaxRequest({
        url: "api/getTimeSlotInformation.php",
        method: 'get',
        handleAs: 'json',
        parameters: {
            timeSlotId: meetingTimeSlotId,
        },
        onSuccess: function (res) {

            console.log(meetingTimeSlotId);
            console.log(res);
            console.log(res[0]);

            switch(res[0]['dayName'])
            {
                case "Mardi":
                    meetingChooseDate = meetingChooseDate +1;
                    break;
                case "Mercredi":
                    meetingChooseDate = meetingChooseDate +2;
                    break;
                case "Jeudi":
                    meetingChooseDate = meetingChooseDate +3;
                    break;
                case "Vendredi":
                    meetingChooseDate = meetingChooseDate +4;
                    break;
                case "Samedi":
                    meetingChooseDate = meetingChooseDate +5;
                    break;
                case "Dimanche":
                    meetingChooseDate = meetingChooseDate +6;
                    break;
            }
        },
        onError: function (status, message) {
        }
    });
}

function clearPopupContainer() {
    let popup = document.getElementById("popup");
    popup.querySelectorAll('*').forEach(n => n.remove());
}

function hideEditMeetingPopup() {
    document.getElementById("popupBackground").hidden = true;
}

function updatePopup()
{

}

/*
 *
 *
 * Merci StackOverFlow pour le lock scroll
 *
 */

var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
    e.preventDefault();
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

// modern Chrome requires { passive: false } when adding event
var supportsPassive = false;
try {
    window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function () { supportsPassive = true; }
    }));
} catch(e) {}

var wheelOpt = supportsPassive ? { passive: false } : false;
var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';

// call this to Disable
function disableScroll() {
    window.addEventListener('DOMMouseScroll', preventDefault, false); // older FF
    window.addEventListener(wheelEvent, preventDefault, wheelOpt); // modern desktop
    window.addEventListener('touchmove', preventDefault, wheelOpt); // mobile
    window.addEventListener('keydown', preventDefaultForScrollKeys, false);
}

// call this to Enable
function enableScroll() {
    window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.removeEventListener(wheelEvent, preventDefault, wheelOpt);
    window.removeEventListener('touchmove', preventDefault, wheelOpt);
    window.removeEventListener('keydown', preventDefaultForScrollKeys, false);
}


function getDateOfISOWeek(w, y) {
    let simple = new Date(y, 0, 1 + (w - 1) * 7);
    let dow = simple.getDay();
    let ISOweekStart = simple;
    if (dow <= 4)
        ISOweekStart.setDate(simple.getDate() - simple.getDay() + 1);
    else
        ISOweekStart.setDate(simple.getDate() + 8 - simple.getDay());
    return ISOweekStart;
}