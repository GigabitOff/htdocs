<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;
use yii\rest\DeleteAction;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Users;

///// Все метода защищені от XSS and SQL-injection
class ApifunctionsystemsController extends Controller
{

    public function actionEmailgo()
    {
        if (!Yii::$app->user->isGuest) {
            $test = "itsystems571@gmail.com";
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{email_school}} WHERE [[send]] = 2")
                ->queryAll();

           // foreach ($posts as $value) {
                $from = "admin@e-osvita.online";
                $to = "itsystems571@gmail.com";
                $subject = "Новий портал для середніх шкіл e-osvita.online";
                $message = "Вітаємо! До вашої уваги новітній портал для середніх шкіл :)
                
                e-Osvita інноваційна система, яка спроможна організувати весь процес дистанційної освіти, спроможна повністю відтворити процесс навчання у школі.

e-Osvita допомагає організувати та проконтролювати розклад уроків та їх проведення.

e-Osvita простежить та унеможливить плутанини для учня та вчителя при онлайн відео - конференціях .

e-Osvita це відсутність будьяких лімітів на виде-конференціі, повна БЕЗКОШТОВНІСТЬ !!! .

e-Osvita створить автоматично конференцію та відкриє її у потрібний час, в потрібному класі, а також унеможливить втручання в навчальний процес інших осіб.

e-Osvita проінформує учня та вчителя о розкладі та вчасно почне і закінчить конференцію та урок.

e-Osvita проінформує, що був доданий новий урок з розкладом, та не дасть запізнитись учню та вчителю, і з 100% точністю відкриє клас-конференцію для учня та вчителя.

e-Osvita проконтролює створення вчителем домашнього завдання та точно відкриє його для потрібного класу або учня.

e-Osvita надає можливість створювати розклад та редагувати його, також є можливість додавати вчителів.

e-Osvita має інструменти для створення тестів та їх оцінювання.

e-Osvita спроможна ЗНАЧНО ПОЛЕГШИТИ та автоматизувати весь процес дистанційної та очної освіти за допомогою ОНЛАЙН ЖУРНАЛУ !";
                $headers = "From:" . $from;
                mail($to, $subject, $message, $headers);
               // Yii::$app->db->createCommand("UPDATE {{email_school}} SET [[send]] = '1' WHERE  [[email]] = '".$value["email"]."'")->execute();

           // }
        }
    }//Метод экранирован и защищён от XSS

}