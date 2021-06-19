<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
if($demo != 0) {
    $this->title = 'DEMO Вхід';
}else{$this->title = 'Вхід';}
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login" style="background-color: ;
	border-radius:5px; background-color: #;">
    <h1 style="color: #ffffff;"><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
    <?php
    if($demo != 0) {
        echo '  <p><span style="color: #ffffff; font-size: 19px; ">Завуч( логин: demo1 пароль: demo1 )</span></p>
    <p><span style="color: #ffffff; font-size: 19px; ">Вчитель( логин: demo2 пароль: demo2 )</span></p>
    <p><span style="color: #ffffff; font-size: 19px; ">Учень( логин: demo3 пароль: demo3 )</span></p>
        ';
    }
    ?>
    <span style="color: #00FF00;">
    <?php

    if(!empty($forgotpassyes)){echo "Ми відправили пароль на ваш email";}

    ?></span>
    <span style="color: #ffffff;"><?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?></span>
    <span style="color: #ffffff;"><?= $form->field($model, 'password')->passwordInput() ?></span>
 </span>
    <tr>
        <td >  <a href="#"  style="margin-left: 100px;" class="btn btn-warning" onclick="history.back();return false;">Назад</a></td><td><a "><?= Html::submitButton('ВХІД', ['class' => 'btn btn-success', 'name' => 'login-button']) ?></a></td>
    </tr>

    <tr>
        <td  > <h3 style=" margin-left: 100px; text-decoration: underline;"><a style="background-color: #ffffff; border-radius: 4px;" href="/site/login?demo=1">DEMO</a></h3></td>
        <td > <h3 style="margin-left: 100px; text-decoration: underline;"><a style="background-color: #ffffff; border-radius: 4px;" href="/site/registrationuchenik">  Реєстрація учня </a></h3></td>
        <td > <h3 style="margin-left: 100px; text-decoration: underline;"><a style="background-color: #ffffff; border-radius: 4px;" href="/site/registrationschool">  Підключити школу </a></h3></td>
        <td > <h3 style="margin-left: 100px; text-decoration: underline;"><a style="background-color: #ffffff; border-radius: 4px;" href="/site/forgotpass">Забув пароль </a></h3></td>
    </tr>

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcRTi8aAAAAAMEzgMlYhQxdAx9PREbu6G5IHzds', {action: 'homepage'}).then(function(token) {
                document.getElementById('login_form').value = token
            });
        });
    </script>
    <?php ActiveForm::end(); ?>
</div>
