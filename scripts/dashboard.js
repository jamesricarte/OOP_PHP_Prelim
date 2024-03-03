document.querySelector('.right-section .profile-icon').addEventListener("click", function(){
    const profileDropdown = document.querySelector('.profile-dropdown');
    if (profileDropdown.style.visibility != 'initial') {
        profileDropdown.style.visibility = 'initial';
    } else {
        profileDropdown.style.visibility = 'hidden';
    }
});

document.querySelector('.right-section .user-name').addEventListener("click", function(){
    const profileDropdown = document.querySelector('.profile-dropdown');
    if (profileDropdown.style.visibility != 'initial') {
        profileDropdown.style.visibility = 'initial';
    } else {
        profileDropdown.style.visibility = 'hidden';
    }
});

/*
document.querySelector('.add-member-button').addEventListener("click", function() {
    document.querySelector('.add-member-button').classList.add('clicked');
})*/

document.querySelector('.add-member-button').addEventListener("click", function() {
    const addPopup = document.querySelector('.add-popup');
    const addPopupForm = document.querySelector('.add-popup form');

    if (addPopup.style.visibility != 'initial' && addPopupForm.style.visibility != 'initial') {
        addPopup.style.visibility = 'initial';
        addPopupForm.style.visibility = 'initial';
    } else {
        addPopup.style.visibility = 'hidden';
        addPopupForm.style.visibility = 'hidden';
    }

});

document.querySelector('.view-button').addEventListener("click", function() {
    const viewPopup = document.querySelector('.view-popup');

    if (viewPopup.style.visibility != 'initial') {
        viewPopup.style.visibility = 'initial';
    } else {
        viewPopup.style.visibility = 'hidden';
    }

});

document.querySelector('.edit-button').addEventListener("click", function() {
    const editPopup = document.querySelector('.edit-popup');
    const editPopupForm = document.querySelector('.edit-popup form');

    if (editPopup.style.visibility != 'initial' && editPopupForm.style.visibility != 'initial') {
        editPopup.style.visibility = 'initial';
        editPopupForm.style.visibility = 'initial';
    } else {
        editPopup.style.visibility = 'hidden';
        editPopupForm.style.visibility = 'hidden';
    }

});