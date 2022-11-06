function newMessage(message)
{
    let feedback_to_admin = document.querySelector(`.modal_content.feedback_to_admin`);

    if (feedback_to_admin.classList.contains('open')) 
    {
        closeWindow('.feedback_to_admin');
        openWindow('.message_to_user');
        document.querySelector('.message_con').innerText = message;

        return;
    }

    openWinMessageToUser(message);
}