function hideEditMeetingPopup() {
    document.getElementById("popup").hidden = true;
    document.getElementById("hiddenInputMeetingId").value = "";
    enableScroll();
}

function showEditMeetingPopup(meetingId) {
    document.getElementById("popup").hidden = false;
    document.getElementById("hiddenInputMeetingId").value = meetingId;
    disableScroll();
}


window.onload = function() {

    let popup = document.createElement("div");
    popup.id = "popup";
    let st = popup.style;
    st.width = '100%';
    st.height = '100%';
    st.backgroundColor = 'rgba(0,0,0, 0.4)';
    st.backdropFilter = 'blur(5px)';
    st.position = 'fixed';
    st.display = 'flex';
    st.justifyContent = 'center';
    st.alignItems = 'center';
    popup.hidden = true;

    let editor = document.createElement("div");
    let edSt = editor.style;
    edSt.padding = '20px 50px';
    edSt.borderRadius = '20px';
    edSt.backgroundColor = "#DDDDDD";
    edSt.display = 'flex';
    edSt.flexDirection = 'column';
    edSt.alignItems = 'center';

    let title = document.createElement("span");
    title.innerText = "Modifier le Rendez-Vous";
    title.style.fontSize = "28px";

    let hiddenInputMeetingId = document.createElement("input");
    hiddenInputMeetingId.name = "meetingId";
    hiddenInputMeetingId.id = "hiddenInputMeetingId"
    hiddenInputMeetingId.type = "text";
    hiddenInputMeetingId.hidden = true;

    let deleteButton = document.createElement("input");
    deleteButton.id = "deleteMeetingButton"
    deleteButton.type = "submit";
    deleteButton.className = "button";
    deleteButton.value = "Supprimer";
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
                url        : "json/deleteMeeting.php",
                method     : 'post',
                handleAs : 'json',
                parameters : {
                    meetingId : hiddenInputMeetingId.value
                },
                onSuccess  : function(res) {
                    hideEditMeetingPopup();
                    console.log("Success ??");
                    console.log(res);
                },
                onError    : function(status, message) {
                    console.log("Une erreur est survenue.")
                }
            }) ;
    }

    popup.appendChild(editor);
    editor.appendChild(title);
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