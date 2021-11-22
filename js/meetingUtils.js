var isPopupActive = false;

window.onload = function() {
    document.onclick = function(e){
        console.log(e.target);
        console.log(e.target.id);
        if(e.target.id == 'popupBackground') {
            removeEditMeetingPopup();
        }
    }
}

function removeEditMeetingPopup() {
    if(isPopupActive) {
        document.getElementById("popupBackground").remove();
        isPopupActive = false;
        enableScroll();
    }
}

function showEditMeetingPopup(meetingId) {
    if(!isPopupActive) {
        isPopupActive = true;
        disableScroll();

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

        let deleteButton = document.createElement("input");
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

        popupBackground.appendChild(editor);
        editor.appendChild(title);
        editor.appendChild(deleteButton);

        document.body.appendChild(popupBackground);
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