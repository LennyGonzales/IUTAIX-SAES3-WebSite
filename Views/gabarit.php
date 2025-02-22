<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/profile.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/errors/error404.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/message.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/login-style.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/main.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/home.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/footer.css">
        <link rel="stylesheet" type="text/css" href="/static/styles/stories.css">
        <link rel="icon" href="/static/content/images/logo-nws.png" type="image/ico" />

        <title>NetWork Stories</title>
    </head>
    <body>
        <?php View::show('standard/header'); ?>
        <?php echo $A_view['body'] ?>
        <?php View::show('standard/footer'); ?>
    </body>
</html>