<section class="form" id="form">
    <h1><a class="anchor" href="#form"><?= $info->name ?></a></h1>
    <form action="/send" method="post" id="main_form_3">
        <div class="row">
            <div class="col-12 col-md-4">
                <input type="text" name="name" id="main_name_3" class="form-text" placeholder="Ваше имя">
            </div>
            <div class="col-12 col-md-4">
                <input type="text" class="form-text" name="phone" id="main_telephone_3" placeholder="Номер телефона">
            </div>
            <div class="col-12 col-md-4">
                <input type="text" name="email" id="main_email_3" class="form-text" placeholder="Контактный E-mail">
            </div>
            <div class="col-12 align-center">
                <button type="submit" class="btn btn-warning"><?= $info->h1 ?></button>
            </div>
        </div>
    </form>
</section>