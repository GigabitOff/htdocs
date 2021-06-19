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
$this->title = 'Вхід';
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
    <p><span style="color: #007fff; font-size: 19px; text-decoration: underline;">DEMO завуч( логин: demo1 пароль: demo1 )</span></p>
    <p><span style="color: #7EFC7E; font-size: 19px; text-decoration: underline;">DEMO вчитель( логин: demo2 пароль: demo2 )</span></p>
    <p><span style="color: #ffffff; font-size: 19px; text-decoration: underline;">DEMO учень( логин: demo3 пароль: demo3 )</span></p>
    <div class="col-lg-offset-1 col-lg-11" style="margin-left: -15px;">
        <input type="button" class="btn btn-primary" value="Назад" onclick="window.history.back()"/>
    </div>
    <div class="form-group">
        <span style="color:#ffffff;">________________________________________________</span>
    </div>
    <tr>
        <td><h3 style="margin-left: 100px; text-decoration: underline;"><a href="/site/registrationuchenik">
                    Реєстрація учня </a></h3></td>
        <td><h3 style="margin-left: 100px; text-decoration: underline;"><a href="/site/registrationschool">
                    Підключити школу </a></h3></td>
        <td><h3 style="margin-left: 100px; text-decoration: underline;"><a href="">Забув пароль </a></h3></td>

    </tr>
    <?php ActiveForm::end(); ?>
</div>
