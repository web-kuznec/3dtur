<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Отправка заявки</title>
    </head>
    <body><?php 
        if(!empty($error))
        {
            echo "<p>".$error."</p><a href='".URL::base('http')."'>Попробовать снова</a>";
        } else {
            echo "<div style='width: 100%; min-height: 500px; background: #22BFF7 url(".URL::base('http')."public/images/zakaz.jpg) top center no-repeat;'></div>";
        } ?>
    </body>
</html>