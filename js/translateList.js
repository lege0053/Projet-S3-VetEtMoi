function translate(textId) {
    return textId in texts ? texts[textId] : textId;
}

const texts = {
    "success_edit_meeting": "Rendez-vous modifié avec succès.",
    "success_delete_meeting": "Rendez-vous supprimé avec succès.",
    "error": "Une erreur est survenue.",
};