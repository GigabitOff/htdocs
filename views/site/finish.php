<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegistrationForm */


$this->title = 'Завершення реєстрації';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->id;
?>

<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]) ?>
<h2>Завершення реєстрації, шаг 2 из 2</h2>
&nbsp;
<div class="alert alert-danger" role="alert">
    Увага. Всі поля обов'язкові до заповнення !
</div>
<span style="color: #ffffff;"> <div class="form-group field-registrationform-city required">
<label class="col-lg-1 control-label" for="registrationform-oblast">Область</label>
<div class="col-lg-3"><select id="registrationform-oblast" onchange="Registrresponseraspraion(this.value);"
                              class="form-control" aria-required="true">
<option value="">Оберіть область</option>
<option value="1">Вінницька область</option>
<option value="2">Волинська область</option>
<option value="3">Дніпропетровська область</option>
        <option value="4">Донецька область</option>
        <option value="5">Житомирська область</option>
        <option value="6">Закарпатська область</option>
        <option value="7">Запорізька область</option>
        <option value="8">Івано-Франківська область</option>
        <option value="9">Київська область</option>
        <option value="10">Кіровоградська область</option>
        <option value="11">Луганська область</option>
        <option value="12">Львівська область</option>
        <option value="13">Миколаївська область</option>
        <option value="14">Одеська область</option>
        <option value="15">Полтавська область</option>
        <option value="16">Рівненська область</option>
        <option value="17">Сумська область</option>
        <option value="18">Тернопільська область</option>
        <option value="19">Харківська область</option>
        <option value="20">Херсонська область</option>
        <option value="21">Хмільницька обл</option>
        <option value="22">Черкаська область</option>
        <option value="23">Чернигівська область</option>
        <option value="24">Чернівецька область</option>
</select></div>
<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div></span>
<span style="color: #ffffff;"> <div class="form-group field-registrationform-city required">
<label class="col-lg-1 control-label" for="registrationform-raion">Район</label>
<div class="col-lg-3"><select id="registrationform-raion" onchange="Registrresponseracity(this.value)"
                              class="form-control" aria-required="true">
</select></div>
<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div></span>
<span style="color: #ffffff;"> <div class="form-group field-registrationform-city required">
<label class="col-lg-1 control-label" for="registrationform-city">Город</label>
<div class="col-lg-3"><select id="registrationform-city" class="form-control"
                              onchange="Registrresponseraschool(this.value)" aria-required="true">
</select></div>
                <script>  function Registrresponseracity(city) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'https://e-osvita.online/api/regraspcity?city=' + city, true);
                        xhr.onload = function () {
                            document.getElementById("registrationform-city").innerHTML = this.responseText;

                        };
                        xhr.send(null);
                    }</script>
<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div></span>
<span style="color: #ffffff;"> <div class="form-group field-registrationform-school required">
<label class="col-lg-1 control-label" for="registrationform-school">Школа</label>
<div class="col-lg-3"><select id="registrationform-school" class="form-control" name="RegistrationForm[school]"
                              aria-required="true">
 <script>  function Registrresponseraschool(school) {
         var xhr = new XMLHttpRequest();
         xhr.open('GET', 'https://e-osvita.online/api/regraspschool?school=' + school, true);
         xhr.onload = function () {
             document.getElementById("registrationform-school").innerHTML = this.responseText;
             alert(school);
         };
         xhr.send(null);
     }</script>
</select></div>
<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div></span>

<?php

if($tipe == 3){?>
<span style="color: #ffffff;"><div class="form-group field-registrationform-classnumber required">
<label class="col-lg-1 control-label" for="registrationform-classnumber">№ класса</label>
<div class="col-lg-3"><select id="registrationform-classnumber" class="form-control"
                              name="RegistrationForm[classnumber]" aria-required="true">
<option value="">Номер класу</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
</select></div>
<div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div></span>
<span style="color: #ffffff;"><div class="form-group field-registrationform-classlater required">
<label class="col-lg-1 control-label" for="registrationform-classlater">Буква класса</label>
<div class="col-lg-3"><select id="registrationform-classlater" class="form-control" name="RegistrationForm[classlater]"
                              aria-required="true">
<option value=''>Оберіть літеру</option>
<option value='A'>А</option>
<option value='Б'>Б</option>
<option value='В'>В</option>
<option value='Г'>Г</option>
<option value='Д'>Д</option>
<option value='Е'>Е</option>
<option value='Ж'>Ж</option>
<option value='З'>З</option>
<option value='І'>І</option>
<option value='К'>К</option>
<option value='Л'>Л</option>
<option value='М'>М</option>
<option value='Н'>Н</option>
<option value='О'>О</option>
<option value='П'>П</option>
<option value='Р'>Р</option>
<option value='С'>С</option>
<option value='Т'>Т</option>
</select>
</div>
            <div class="col-lg-8"><p class="help-block help-block-error "></p></div>
</div></span>
<?php }?>
<script>  function Registrresponseraspraion(oblast) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/regraspnp?oblast=' + oblast, true);
        xhr.onload = function () {
            document.getElementById("registrationform-raion").innerHTML = this.responseText;
        };
        xhr.send(null);
    }</script>
</tr>
&nbsp;
<?php

if($tipe == 3){?>
<script>  function Registrationuchenic() {
        var user_id = <?php   echo $id ?>;
        var oblast = document.getElementById('registrationform-oblast').value;
        var raion = document.getElementById('registrationform-raion').value;
        var city = document.getElementById('registrationform-city').value;
        var school = document.getElementById('registrationform-school').value;
        var classnumber = document.getElementById('registrationform-classnumber').value;
        var classlater = document.getElementById('registrationform-classlater').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/reguch?id=' + user_id + "&city=" + city + "&school=" + school+ "&classnumber=" + classnumber + "&classlater=" + classlater, true);
        xhr.onload = function () {
            if (this.responseText == 1) {
                document.location.href = "../myroom/index";
            }
        };
        xhr.send(null);
    }</script>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <button type="submit" onclick="Registrationuchenic();" class="btn btn-primary">Регистрация</button>
    </div>
</div>
<?php }?>
<?php

if($tipe == 4){?>
    <script>  function Registrationuchenic() {
            var user_id = <?php   echo $id ?>;
            var oblast = document.getElementById('registrationform-oblast').value;
            var raion = document.getElementById('registrationform-raion').value;
            var city = document.getElementById('registrationform-city').value;
            var school = document.getElementById('registrationform-school').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://e-osvita.online/api/reguch?id=' + user_id + "&city=" + city + "&school=" + school, true);
            xhr.onload = function () {
                if (this.responseText == 1) {
                    document.location.href = "../myroom/index";
                }
            };
            xhr.send(null);
        }</script>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <button type="submit" onclick="Registrationuchenic();" class="btn btn-primary">Регистрация</button>
        </div>
    </div>
<?php }?>
<?php ActiveForm::end(); ?>

</div>

