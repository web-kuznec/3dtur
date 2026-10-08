<form id="autorizy">
    <div class="labeled"><label for="username">Логин:</label></div>
    <div class="inpt_auth">
        <input id="username" class="inptext" type="text" name="username" autofocus <?php if(isset($_COOKIE['login'])) { ?>value="<?= $_COOKIE['login']; ?>"<?php } ?> />
    </div>
    <div class="clear"></div>
    <div class="labeled"><label for="password">Пароль:</label></div>
    <div class="inpt_auth">
        <input id="password" class="inptext" type="password" name="password" <?php if(isset($_COOKIE['pass'])) { ?>value="<?= $_COOKIE['pass']; ?>"<?php } ?> />
    </div>
    <div class="clear"></div>
    <div class="fleft">Запомнить меня: <input type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE['login'])) { echo "checked"; } ?>></div>
    <div class="fright"><button class="button" type="submit">Войти</button></div>
    <div class="clear"></div>
</form>
<div class="otst"></div>
<div class="clear"></div>