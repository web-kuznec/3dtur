<section id="order">
    <div class="container">
        <h2><?= $sl3->h1; ?></h2>
        <div class="row">
            <form action="/send" method="post" id="main_form_3" class="contact-form">
                <div class="col-md-12 cnt-inpt">
                    <input name="name" type="text" placeholder="ИМЯ" id="main_name_3">
                </div>
                <div class="col-md-6 cnt-inpt">
                    <input name="phone" type="text" placeholder="НОМЕР ТЕЛЕФОНА" id="main_telephone_3" required="">
                </div>
                <div class="col-md-6 cnt-inpt">
                    <input name="email" type="text" placeholder="КОНТАКТНЫЙ E-MAIL" id="main_email_3">
                </div>
                <div class="col-md-12 cnt-inpt">
                    <input type="submit" value="ОТПРАВИТЬ">
                </div>
            </form>
        </div>
    </div>
</section>