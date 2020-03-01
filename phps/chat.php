<!DOCTYPE html>

<html lang = "ru">
  <head>
    <header>
      <a href="/">
        <img src="..\images\fuga1.png" alt="Fuga Logo"/>
        <h1>Fuga Site</h1>
      </a>
    </header>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
    <link rel="stylesheet", type="text/css", href="../css/phpchatstyle.css">
    <link rel="icon" href="..\images\fuga1.png" type="image/x-icon">
    <link rel="shortcut icon" href="..\images\fuga1.png" type="image/x-icon">
    <h1 class = "main-h">Test Chat</h1>
  </head>
  <body>
    <div class="scrollings">
      А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации. А тут много-много разного текста и прочей информации.
    </div>
    <form name="form" action="" method="get">
      <input type="text" name="chat" id="chat" value="Message...">
    </form>
    <?php
echo $_POST['login'];
    ?>
  </body>
</html>
