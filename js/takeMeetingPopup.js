//////////////////////
// Popup Background //
//////////////////////
let meetingAnimalId = '';
let meetingSpeciesId = '';
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
title.innerText = "Modifier le Rendez-Vous";
title.style.fontSize = "28px";


///////////////////
// Delete Button //
///////////////////
let deleteButton = document.createElement("input");
deleteButton.id = "deleteMeetingButton";
deleteButton.type = "submit";
deleteButton.className = "button";
deleteButton.value = "Supprimer le rendez-vous";
deleteButton.style.padding = "12px 25px";
deleteButton.style.fontSize = "18px";
deleteButton.style.backgroundColor = "#C20D0D";
deleteButton.style.transition = "0.2s background-color ease-in-out";
deleteButton.onmouseover = function() {
    this.style.backgroundColor = "#810000";
}

deleteButton.onmouseleave = function(){
    this.style.backgroundColor = "#C20D0D";
}
deleteButton.onclick = function() {
    let ajaxRequest = new AjaxRequest(
        {
            url: "trmt/deleteMeeting.php",
            method: 'post',
            handleAs: 'json',
            parameters: {
                meetingId: hiddenInputMeetingId.value
            },
            onSuccess: function (res) {
                console.log("Success ??");
                console.log(res);
                if (res) {
                    if (res['success']) {
                        clearPopupContainer();
                        popup.appendChild(title);
                    } else if (res['error']) {
                        clearPopupContainer();
                        popup.appendChild(title);
                    }
                }
            },
            onError: function (status, message) {
                clearPopupContainer();
                popup.appendChild(title);
            }
        });
    this.style.backgroundColor = "#c20d0d";
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
    popup.appendChild(title);
    popup.appendChild(deleteButton);

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
    meetingTimeSlotTypeId = tstId;
    meetingYear = y;
    meetingWeek = w;

    title.innerText = "Prendre Rendez-Vous";
    document.getElementById("popupBackground").hidden = false;
    disableScroll();
}

function clearPopupContainer() {
    let popup = document.getElementById("popup");
    popup.querySelectorAll('*').forEach(n => n.remove());
}

function hideEditMeetingPopup() {
    document.getElementById("popupBackground").hidden = true;
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