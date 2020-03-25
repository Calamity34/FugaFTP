var messages__container = document.getElementById('messages'); 
var interval = null;
var sendForm = document.getElementById('chat-form');
var messageInput = document.getElementById('message-text');
function send_request(act, login = null, password = null) {
	var var1 = null;
	var var2 = null;
	
	if(act == 'auth') {
		var1 = login;
		var2 = password;
	} else if(act == 'send') {
		var1 = messageInput.value;
	}
	
    $.post('../chat.php',{ 
            act: act,
            var1: var1,
            var2: var2
    }).done(function (data) {
            messages__container.innerHTML = data;
            if(data == 'Проблема авторизации') {
                clearInterval(interval); //Если проблема авторизации, отключаем автообновление
                if(login == null && password == null) {
                    login = prompt('Введите логин: ');//Запрашиваем логин
                    if(login != null) {
                        password = prompt('Введите пароль: ');//Запрашиваем пароль
                        send_request('auth',login,password); //Отправляем еще один запрос
                    }
                }
            } 
            if(act == 'auth') {
                interval = setInterval(update,500); //Заново запускаем автообновление
            }
            if(act == 'send') {
                messageInput.value = '';
            }
    });
}
function update() {
	send_request('load');
}
interval = setInterval(update,500);
sendForm.onsubmit = function () {
	send_request('send');
	return false; //Возвращаем ложь, чтобы остановить классическую отправку формы
};