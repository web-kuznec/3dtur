<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Send extends Controller_Common
{
    public $template = 'send';

    public function action_index()
    {
        $type = "";
        if(isset($_POST['phone']))
            $phone = $_POST['phone'];
        if(isset($_POST['name']))
            $name = $_POST['name'];
        if(isset($_POST['email']))
            $email = $_POST['email'];
        if(isset($_POST['type']))
            $type = $_POST['type'];

        $response = $_POST["g-recaptcha-response"];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => "6LcJWdUUAAAAAO5Et0Zm6n1if1LE88b_GQrzMot-",
            'response' => $response
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);

        if ($output->success==false) {
            $this->template->error = "Подтвердите что вы не робот";
        } elseif ($output->success==true) {
            // сохраняем данные, отправляем письма, делаем другую работу. Пользователь не робот
            $post = Validation::factory($_POST); // готовимся к проведению валидации
            $post->rule('email', 'not_empty');
            $post->rule('email', 'email');
            $post->rule('phone', 'not_empty');
            $post->rule('phone', 'min_length', array(':value', 6));
            $post->rule('phone', 'max_length', array(':value', 17));
            if($post -> check())
            {
                /* Сюда впишите свою эл. почту */
                $address = "palap277@yandex.ru,yasv-777@yandex.ru,3dtur24@mail.ru,yasv-777@mail.ru";

                /* А здесь прописывается текст сообщения, \n - перенос строки */
                $mes = "Тема: Заказ!<br>Телефон: $phone<br>Имя: $name<br>E-mail: $email<br>";

                /* А эта функция как раз занимается отправкой письма на указанный вами email */
                $sub = 'Заказ с сайта 3dtur24'; //сабж
                //$email = '3dtur24@mail.ru<3dtur24.ru>'; // от кого

                $headers = "Content-Type: text/html; charset=utf-8\n";  
                $headers .= "MIME-Version: 1.0\n";  
                $headers .= "Content-Transfer-Encoding: 8bit\n";
                $headers .= "From: info@3dtur24.ru";
                mail($address, $sub, $mes, $headers);
                //mail($address, $sub, $mes, "MIME-Version: 1.0\n Content-type:text/plain; charset = utf-8\r\nFrom:$email");
                ini_set('short_open_tag', 'On');
                header('Refresh: 3; URL=/');
            }
            else
            {
                $this->template->error = "Неверно заполнены или незаполнены поля телефон или E-mail";
            }
        }
    }

} // End Welcome