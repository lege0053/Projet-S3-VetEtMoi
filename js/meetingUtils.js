var popup = document.createElement("div");
popup.id = "popup";
var st = popup.style;
st.width = '100%';
st.height = '100%';
st.backgroundColor = 'rgba(0,0,0, 0.4)';
st.backdropFilter = 'blur(5px)';
st.position = 'fixed';
st.display = 'flex';
st.justifyContent = 'center';
st.alignItems = 'center';
popup.hidden = true;

var editor = document.createElement("div");
editor.id = "editor";
var edSt = editor.style;
edSt.padding = '20px 50px';
edSt.borderRadius = '20px';
edSt.backgroundColor = "#DDDDDD";
edSt.display = 'flex';
edSt.flexDirection = 'column';
edSt.alignItems = 'center';
edSt.gap = '20px';

var editTitle = document.createElement("span");
editTitle.innerText = "Modifier le Rendez-Vous";
editTitle.style.fontSize = "28px";

var successTitle = document.createElement("span");
successTitle.innerText = "";
successTitle.style.fontSize = "28px";

var errorTitle = document.createElement("span");
errorTitle.innerText = "Une erreur est survenue";
errorTitle.style.fontSize = "28px";

var hiddenInputMeetingId = document.createElement("input");
hiddenInputMeetingId.name = "meetingId";
hiddenInputMeetingId.id = "hiddenInputMeetingId"
hiddenInputMeetingId.type = "text";
hiddenInputMeetingId.hidden = true;

var continueButton = document.createElement("input");
continueButton.id = "continueButton"
continueButton.type = "submit";
continueButton.className = "button";
continueButton.value = "Continuer";
continueButton.style.padding = "12px 25px";
continueButton.style.fontSize = "18px";
continueButton.onclick = function(){
    hideEditMeetingPopup();
}

var deleteButton = document.createElement("input");
deleteButton.id = "deleteMeetingButton"
deleteButton.type = "submit";
deleteButton.className = "button";
deleteButton.value = "Annuler le rendez-vous";
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
            url: "api/deleteMeeting.php",
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
                        if(res['success'] == 'success_delete_meeting')
                            successTitle.innerText = "Rendez-vous supprimé avec succès";
                        editor.appendChild(successTitle);
                        editor.appendChild(continueButton);
                    } else if (res['error']) {
                        clearPopupContainer();
                        editor.appendChild(errorTitle);
                        editor.appendChild(continueButton);
                    }
                }
            },
            onError: function (status, message) {
                clearPopupContainer();
                editor.appendChild(errorTitle);
                editor.appendChild(continueButton);
            }
        });
}



function hideEditMeetingPopup() {
    document.getElementById("popup").hidden = true;
    clearPopupContainer();
    editor.appendChild(editTitle);
    editor.appendChild(hiddenInputMeetingId);
    editor.appendChild(deleteButton);

    document.getElementById("hiddenInputMeetingId").value = "";
    enableScroll();
}

function showEditMeetingPopup(meetingId) {
    document.getElementById("popup").hidden = false;
    document.getElementById("hiddenInputMeetingId").value = meetingId;
    disableScroll();
}

function clearPopupContainer() {
    let editor = document.getElementById("editor");
    editor.querySelectorAll('*').forEach(n => n.remove());
}


window.onload = function() {
    popup.appendChild(editor);
    editor.appendChild(editTitle);
    editor.appendChild(hiddenInputMeetingId);
    editor.appendChild(deleteButton);
    document.body.appendChild(popup);

    document.onclick = function(e){
        if(e.target.id == 'popup') {
            hideEditMeetingPopup();
        }
    }
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