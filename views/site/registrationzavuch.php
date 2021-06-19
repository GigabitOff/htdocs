<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */



$this->title = 'Реєстрація завуча крок 1 з 2';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert alert-info" role="alert">
    <a href="" class="alert-link">Кожна школа котра реєструеться в системі, підлягає перевірці введених данних :)</a>
</div>

<div class="site-login" style="background-color: ;
	border-radius:5px; background-color: #;">
    <h1   style="color: #ffffff;"><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'registration-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]) ?>
    <span  style="color: #ffffff;"><h3>Увага ! Кожна школа реєструється на им`я завуча !</h3></span>
    <span>&nbsp;</span>
    <span style="color: #ffffff;"><?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?></span>
    <span style="color: #ffffff;"><?= $form->field($model, 'password')->passwordInput() ?></span>
    <span style="color: #ffffff;"><?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?></span>
    <span style="color: #ffffff;"><?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?></span>
    <span style="color: #ffffff;"> <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?></span>
    <span style="color: #ffffff;"> <?= $form->field($model, 'telefon')->textInput(['autofocus' => true])?></span>

    <span style="color: #ffffff;"> <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '{image}{input}',
        ]) ?></span>
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
