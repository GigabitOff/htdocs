<?php

namespace app\controllers;
use Yii;
use yii\helpers\HtmlPurifier;


class XssController extends \yii\web\Controller
{

    public static function encode($text)
    {
        return htmlspecialchars($text);
    }

    public function actionSimple()
    {
       echo HtmlPurifier::process($_GET['username']);


    }

}
