<?php

namespace app\controllers;

use app\models\Users;

class UsersController extends \yii\web\Controller
{
    public function action()
    {
        return $this->render('index');
    }

    public function actionUserData($id)
    {
        return 1;
    }

}
