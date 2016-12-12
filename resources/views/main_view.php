<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeeJee Reviews</title>
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
<section id="feedbacks">
    <div class="container">
        <div class="row">
            <h1 class="feedbacks-title text-center">
                Отзывы
            </h1>
            <div class="text-center">
                Сортировать по:
                <a href="/?order=name&sort=asc">Имя</a>
                <a href="/?order=email&sort=asc">Email</a>
                <a href="/?order=created&sort=desc">Дата добавления</a>
            </div>
            <div class="col-md-offset-2 col-md-8">
                <?php if (!empty($data)) foreach ($data as $feedback) {?>
                    <?php if(FeedbackService::feedbackIsVisible($feedback->getStatus())) {?>
                    <div class="feedback">
                        <h3 class="feedback-name"><?=$feedback->getName()?></h3>
                        <h4 class="feedback-email"><?=$feedback->getEmail()?></h4>
                        <h4 class="feedback-text"><?=$feedback->getText()?></h4>
                        <!--div class="feedback-image"></div>-->
                        <?php if (Auth::isAdmin()) {?>
                            <?php if ($feedback->getStatus() == 0) {?>
                            <div>
                                <a href="/feedback/accept?id=<?=$feedback->getId()?>">Accept</a>
                                <a href="/feedback/reject?id=<?=$feedback->getId()?>">Reject</a>
                            </div>
                            <?php } ?>
                            <?php if ($feedback->getStatus() == 1) {?>
                                <div>
                                    Accepted
                                </div>
                            <?php } ?>
                            <?php if ($feedback->getStatus() == 2) {?>
                                <div>
                                    Rejected
                                </div>
                            <?php } ?>
                            <a data-id="<?=$feedback->getId()?>" class="feedback-edit">Изменить</a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <h2 class="form-title">
                    Ваш отзыв
                </h2>
                <form action="feedback/create" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="text" placeholder="Текст"></textarea>
                    </div>
                    <div class="flex-right">
                        <button class="btn btn-info">Предварительный просмотр</button>
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>