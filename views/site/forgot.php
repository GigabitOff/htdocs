<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */



$this->title = 'Нагадування пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" style="background-color: ;
	border-radius:5px; background-color: #;">
    <h1   style="color: #ffffff;"><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'forgot-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]) ?>
    <span style="color: #00FF00;">
    <?php

    if($email == "false"){echo "Такий email в системі не зареєстровано";}

    ?></span>
    <span style="color: #ffffff;"> <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?></span>

    <tr >
        <td > <h3><a href="/site/login" style="margin-left:100px; text-decoration: underline; background-color: #ffffff; border-radius: 4px;">Вхід </a></td>
        <td></td>
        <td></h3></td>
    </tr>
    </tr>
    &nbsp;
    <tr>
        <td >  <a href="#"  style="margin-left: 100px;" class="btn btn-warning" onclick="history.back();return false;">Назад</a></td><td><a "><?= Html::submitButton('Далі', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?></a></td>

    </tr>
    <?php ActiveForm::end(); ?>

</div>
