<?php
// Страница авторизации 
// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
} 
// Соединяемся с БД
$link=mysqli_connect("localhost", "root", "", "testmodul29"); 
if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняется введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query); 
    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
 
        if(!empty($_POST['not_attach_ip']))
        {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        } 
        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'"); 
        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!! 
        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: check"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
        $log->debug('неудачный вход', array('user' => $_POST['login'], 'time' => date('H:i:s d.m.Y'))); 
    }
}
// Параметры приложения
$clientId     = '7780824'; // ID приложения
$clientSecret = 'zgb0qxabponUViJKDDjc'; // Защищённый ключ
$redirectUri  = 'http://localhost:8080/log'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
 
// Формируем ссылку для авторизации
$params = array(
    'client_id'     => $clientId,
    'redirect_uri'  => $redirectUri,
    'response_type' => 'code',
    'v'             => '5.126', // (обязательный параметр) версиb API https://vk.com/dev/versions
 
    // Права доступа приложения https://vk.com/dev/permissions
    // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
    // Если не указать "offline", то полученный токен будет жить 12 часов.
    'scope'         => 'photos,offline',
);

if (isset($_GET['code'])) {
    $result = true;
    $params = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirectUri
    ];

    if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
        $error = error_get_last();
        throw new Exception('HTTP request failed. Error: ' . $error['message']);
    }
 
    $response = json_decode($content);
 
    // Если при получении токена произошла ошибка
    if (isset($response->error)) {
        throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
    }
 //А вот здесь выполняем код, если все прошло хорошо
    $token = $response->access_token; // Токен
    $expiresIn = $response->expires_in; // Время жизни токена
    $userId = $response->user_id; // ID авторизовавшегося пользователя
 
    // Сохраняем токен в сессии
    $_SESSION['token'] = $token;
    $_SESSION['auth'] = true;

    mysqli_query($link,"INSERT INTO users SET user_login='".$userId."', access = 2, user_token='".$token."'");
    if(isset($_SESSION['token']))
{
    header("Location: look"); exit();
}


}

?>
<div class="container"> 
    <h1>Авторизация пользователя</h1>
    <form method="POST">
        <div class="row" style="padding: 20px 0px">
            <div class="col">
                Логин <input name="login" type="text" required><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Пароль <input name="password" type="password" required><br> 
            </div>
        </div>
        <div class="row" style="padding: 20px 0px">
            <div class="col">
                Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip">
            </div>
        </div>
        <div>
            <input name="submit" type="submit" value="Войти" class="btn btn-primary">
            <br>
            <?php echo '<a href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">ВК </a>';?>
        </div>
    </form>
</div>




