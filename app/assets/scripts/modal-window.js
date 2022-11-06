const open_win_feedback_to_admin = document.querySelector('.connectionwithadmin'),
btn_close_win_feedback_to_admin = document.querySelector('.modal_content.feedback_to_admin button.btn-close'),
btn_close_win_message_to_user = document.querySelector('.modal_content.message_to_user button.btn-close'),
cover = document.querySelector('.cover'),
body = document.querySelector('body');

open_win_feedback_to_admin.addEventListener('click', () => {
    toggleWindow('.feedback_to_admin');
});

btn_close_win_feedback_to_admin.addEventListener('click', () => {
    toggleWindow('.feedback_to_admin');
});

btn_close_win_message_to_user.addEventListener('click', () => {
    openWinMessageToUser('');
});

function openWinMessageToUser(message) {
    toggleWindow('.message_to_user');
    document.querySelector('.message_con').innerText = message;
}

function toggleWindow(className) {
    body.classList.toggle('modal_open');
    cover.classList.toggle('open');
    document.querySelector(`.modal_content${className}`).classList.toggle('open');
}

function closeWindow(className) {
    document.querySelector(`.modal_content${className}`).classList.remove('open');
}

function openWindow(className) {
    document.querySelector(`.modal_content${className}`).classList.add('open');
}