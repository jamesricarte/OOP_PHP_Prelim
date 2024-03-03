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