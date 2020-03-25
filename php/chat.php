<!DOCTYPE html>

<html lang = "ru">
  <head>
    <header>
      <a href="/">
        <img src="..\images\favicon.png" alt="Fuga Logo"/>
        <h1>Fuga Site</h1>
      </a>
    </header>
    <script src="../js/chat.js"></script>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../css/phpchatstyle.css">
    <link rel="icon" href="..\images\favicon.png">
    <link rel="shortcut icon" href="..\images\favicon.png" type="image/x-icon">
    <h1 class = "main-h">Test Chat</h1>
  </head>
  <body>
    <div class='chat'>
      <div class='chat-messages'>
        <div class='chat-messages__content' id='messages'>
          Загрузка...
        </div>
      </div>
      <div class='chat-input'>
        <form method='post' id='chat-form'>
          <input type='text' id='message-text' class='chat-form__input' placeholder='Введите сообщение'> <input type='submit' class='chat-form__submit' value='=>'>
        </form>
      </div>
    </div>
    <?php
session_start();
$db = mysqli_connect("sql112.ezyro.com","ezyro_25366915","4jh1l9forfygmf9"); 
mysqli_select_db($db,"chat");
$_SESSION['login'] = '4qT1vktQ9B';
$_SESSION['password'] = 't2XwKyYHCB';
$_SESSION['id'] = 1;
function auth($db,$login,$pass) {
	//Находим совпадение в базе данных
	$result = mysqli_query($db,"SELECT * FROM userlist WHERE login='$login' AND password='$pass'");
	if($result) {
		if(mysqli_num_rows($result) == 1) {//Проверяем, одно ли совпадение
			$user = mysqli_fetch_array($result); //Получаем данные пользователя и заносим их в сессию
			$_SESSION['login'] = $login;
			$_SESSION['password'] = $pass;
			$_SESSION['id'] = $user['id'];
			return true; //Возвращаем true, потому что авторизация успешна
		} else {
			unset($_SESSION); //Удаляем все данные из сессии и возвращаем false, если совпадений нет или их больше 1
			return false;
		}
	} else {
		return false; //Возвращаем ложь, если произошла ошибка
	}
}
function load($db) {
	$echo = "";
	if(auth($db,$_SESSION['login'],$_SESSION['password'])) {//Проверяем успешность авторизации
		$result = mysqli_query($db,"SELECT * FROM messages"); //Запрашиваем сообщения из базы
		if($result) {
			if(mysqli_num_rows($result) >= 1) {
				while($array = mysqli_fetch_array($result)) {//Выводим их с помощью цикла
					$user_result = mysqli_query($db,"SELECT * FROM userlist WHERE id='$array[user_id]'");//Получаем данные об авторе сообщения
					if(mysqli_num_rows($user_result) == 1) {
						$user = mysqli_fetch_array($user_result);
						$echo .= "<div class='chat__message chat__message_$user[nick_color]'><b>$user[login]:</b> $array[message]</div>"; //Добавляем сообщения в переменную $echo
					}
				}
			
			} else {
				$echo = "Нет сообщений!";//В базе ноль записей
			}
		}
	} else {
		$echo = "Проблема авторизации";//Авторизация не удалась
	}
	
	return $echo;//Возвращаем результат работы функции
}
function send($db,$message) {
	if(auth($db,$_SESSION['login'],$_SESSION['password'])) {//Если авторизация удачна
		$message = htmlspecialchars($message);//Заменяем символы ‘<’ и ‘>’на ASCII-код
		$message = trim($message); //Удаляем лишние пробелы
		$message = addslashes($message); //Экранируем запрещенные символы
		$result = mysqli_query($db,"INSERT INTO messages (user_id,message) VALUES ('$_SESSION[id]','$message')");//Заносим сообщение в базу данных
	}
	return load($db); //Вызываем функцию загрузки сообщений
}
//Получаем переменные из супермассива $_POST
//Тут же их можно проверить на наличие инъекций
if(isset($_POST['act'])) {$act = $_POST['act'];}
if(isset($_POST['var1'])) {$var1 = $_POST['var1'];}
if(isset($_POST['var2'])) {$var2 = $_POST['var2'];}

switch($_POST['act']) {//В зависимости от значения act вызываем разные функции
	case 'load': 
		$echo = load($db); //Загружаем сообщения
	break;
	
	case 'send': 
		if(isset($var1)) {
			$echo = send($db,$var1); //Отправляем сообщение
		}
	break;
	
	case 'auth': 
		if(isset($var1) && isset($var2)) {//Авторизуемся
			if(auth($db,$var1,$var2)) {
				$echo = load($db);
			}
		}
	break;
}

echo $echo;//Выводим результат работы кода
    ?>
  </body>
</html>
