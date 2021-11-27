//////////////////////
// Popup Background //
//////////////////////
var popupBackground = document.createElement("div");
popupBackground.id = "popupBackground";
var st = popupBackground.style;
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
var popup = document.createElement("div");
popup.id = "popup";
var edSt = popup.style;
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
var title = document.createElement("span");
title.innerText = "Modifier le Rendez-Vous";
title.style.fontSize = "28px";

///////////////////
// Cancel Button //
///////////////////
var cancelEdit = document.createElement("input");
cancelEdit.id = "cancelButton"
cancelEdit.type = "submit";
cancelEdit.className = "button";
cancelEdit.value = "Annuler la modification";
cancelEdit.style.padding = "12px 25px";
cancelEdit.style.fontSize = "18px";
cancelEdit.onclick = function(){
    onExitPopup();
}

/////////////////////
// Continue Button //
/////////////////////
var continueButton = document.createElement("input");
continueButton.id = "continueButton"
continueButton.type = "submit";
continueButton.className = "button";
continueButton.value = "Continuer";
continueButton.style.padding = "12px 25px";
continueButton.style.fontSize = "18px";
continueButton.onclick = function(){
    onExitPopup();
}

/////////////////////////////////////////////
// Hidden Input with Meeting Id For DELETE //
/////////////////////////////////////////////
var hiddenInputMeetingId = document.createElement("input");
hiddenInputMeetingId.name = "meetingId";
hiddenInputMeetingId.id = "hiddenInputMeetingId"
hiddenInputMeetingId.value = "";
hiddenInputMeetingId.type = "text";
hiddenInputMeetingId.hidden = true;

////////////////
// Bottom Div //
////////////////
var actionListDiv = document.createElement("div");
actionListDiv.id = "actionListDiv";
actionListDiv.style.display = "flex";
actionListDiv.style.columnGap = "10px";


/////////////////////
// End Edit Button //
/////////////////////
var editButton = document.createElement("input");
editButton.id = "editMeetingButton";
editButton.type = "submit";
editButton.className = "button";
editButton.value = "Modifier le rendez-vous";
editButton.style.padding = "12px 25px";
editButton.style.fontSize = "18px";

///////////////////
// Delete Button //
///////////////////
var deleteButton = document.createElement("input");
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
                        let meetingId = document.getElementById("hiddenInputMeetingId").value;
                        document.getElementById("meeting-" + meetingId).remove();

                        clearPopupContainer();

                        title.innerText = translate(res['success']);
                        popup.appendChild(title);
                        popup.appendChild(continueButton);
                    } else if (res['error']) {
                        clearPopupContainer();
                        popup.appendChild(title);
                        popup.appendChild(continueButton);
                    }
                }
            },
            onError: function (status, message) {
                clearPopupContainer();
                popup.appendChild(title);
                popup.appendChild(continueButton);
            }
        });
    this.style.backgroundColor = "#C20D0D";
}

///////////////
// Functions //
///////////////
window.onload = function() {
    appendOriginalElement();
    document.onclick = function(e){
        if(e.target.id == 'popupBackground') {
            onExitPopup();
        }
    }
}

function onExitPopup() {
    hideEditMeetingPopup();
    clearPopupContainer();
    appendOriginalElement();
    enableScroll();
}

function showEditMeetingPopup(meetingId) {
    title.innerText = "Modifier le Rendez-Vous";
    document.getElementById("popupBackground").hidden = false;
    document.getElementById("hiddenInputMeetingId").value = meetingId;
    disableScroll();
}

function clearPopupContainer() {
    let popup = document.getElementById("popup");
    popup.querySelectorAll('*').forEach(n => n.remove());
}

function hideEditMeetingPopup() {
    document.getElementById("popupBackground").hidden = true;
}

function appendOriginalElement() {
    popupBackground.appendChild(popup);
    actionListDiv.appendChild(editButton);
    actionListDiv.appendChild(deleteButton);

    popup.appendChild(title);
    popup.appendChild(hiddenInputMeetingId);
    popup.appendChild(cancelEdit);
    popup.appendChild(actionListDiv);

    document.body.appendChild(popupBackground);
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