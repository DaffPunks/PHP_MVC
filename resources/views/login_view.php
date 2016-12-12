<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="scripts/dist/scriptES6.js" defer></script>
</head>
<body>
<nav id="navbar navbar-static-top">
    <div class="container flex-right">
        <?php if(Auth::isAuth()) {?>
            <?=Auth::getUserName() ?>
            <a href="/logout">Logout</a>
        <?php } else {?>
            <a href="/login">Login</a>
        <?php }?>
    </div>
</nav>
<section id="form">
    <div class="container">
        <h2 class="form-title text-center">
            Войти
        </h2>
        <div class="col-md-offset-3 col-md-6">
            <?php if (!empty($data)) foreach ($data as $error) { echo $error; }?>
            <form action="login" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="login" id="exampleInputEmail1" placeholder="Имя">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Пароль">
                </div>
                <button type="submit" class="btn btn-success">Отправить</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>