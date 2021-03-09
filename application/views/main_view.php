<?php 
	$_SESSION['auth'] = false;
 ?>
<div class="container">
	<h1>Добро пожаловать на сайт проверки авторизации!!!</h1> 
	<div class="row">
		<p>
			Для просмотра изображения и текста необходимо зарегистрироваться или авторизоваться!
		</p>

		<p>
			Для просмотра изображения необходимо авторизоваться через ВК! 
		</p>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<Button type="button" class="btn btn-outline-warning"><a href="/log">Авторизация!</a></Button>
		</div>
		<div class="col-sm-4">
			<Button  type="button" class="btn btn-outline-warning"><a href="/form">Регистрация!</a></Button>
		</div>
	</div>
</div>
<?php 
print_r($_SESSION['auth'])
 ?>



