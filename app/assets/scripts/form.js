const formsList = document.querySelectorAll('form.form-send');

formsList.forEach(form => {
    form.addEventListener('submit', e => {
        submitForm(e);
    });
});

function submitForm(e) {
    e.preventDefault();

    let body = new FormData(e.target);

    request(e.target.action, e.target.method, body);

    e.target.reset();
}

function request(url, method, body = {}) {
    let xhr;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xhr.open(method, url, true);

    xhr.responseType = 'json';

    xhr.onload = () => {
        if(xhr.status === 200){
            if (xhr.response.type === 'redirect') {
                location.href = xhr.response.url;
            }
            if (xhr.response.type === 'success') {
                newMessage(xhr.response.message.message);
            }
            if (xhr.response.type === 'showresult')
            {
                showInstructions(xhr.response.message.result);
                location.href = xhr.response.url;
            }
            if (xhr.response.type === 'error') {
                newMessage(xhr.response.message);
            }
            return;
        }

        console.log('Не удалось подключиться к серверу!');
    }

    xhr.send(body);
}