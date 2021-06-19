<?php

use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$id = Yii::$app->user->id;
/* @var $this yii\web\View */
$this->title = 'Журнал';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php  $tranzaction_code_security; ?>
<style>
    .table_sort table {
        border-collapse: collapse;
    }

    .table_sort th {
        color: #ffebcd;
        background: #008b8b;
        cursor: pointer;
    }

    .table_sort td,
    .table_sort th {
        width: 150px;
        height: 40px;
        text-align: center;
        border: 2px solid #846868;
    }

    .table_sort tbody tr:nth-child(even) {
        background: #e3e3e3;
    }

    th.sorted[data-order="1"],
    th.sorted[data-order="-1"] {
        position: relative;
    }

    th.sorted[data-order="1"]::after,
    th.sorted[data-order="-1"]::after {
        right: 8px;
        position: absolute;
    }

    th.sorted[data-order="-1"]::after {
        content: "▼"
    }

    th.sorted[data-order="1"]::after {
        content: "▲"
    }

</style>
<style>

    .hide {
        display: none;
    }

    .hide + label ~ div {
        display: none;
    }

    .hide + label {
        border-bottom: 1px dotted green;
        padding: 0;
        color: green;
        cursor: pointer;
        display: inline-block;
        font-size: 21px;
    }

    .hide:checked + label {
        color: red;
        border-bottom: 0;
    }

    .hide:checked + label + div {
        display: block;
        background: #efefef;
        -moz-box-shadow: inset 3px 3px 10px #7d8e8f;
        -webkit-box-shadow: inset 3px 3px 10px #7d8e8f;
        box-shadow: inset 3px 3px 10px #7d8e8f;
        padding: 10px;
    }

    .demo {
        margin: 5% 10%;
    }</style>
<style>
    body {
        font-family: "Lato", sans-serif;
    }

    .sidebar {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        opacity: 0.9;
    }

    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #ffffff;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        color: #f1f1f1;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 11px;
        right: 100px;
        font-size: 60px;
        margin-left: 50px;

    }

    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #778899;
        color: white;
        padding: 10px 15px;

        border-radius: 5px;

    }

    .openbtn:hover {
        background-color: #cccccc;
    }

    @media screen and (max-height: 450px) {
        .sidebar {
            padding-top: 15px;
        }

        .sidebar a {
            font-size: 18px;
        }
    }

    #main {
        margin: 0px;
        background: e6eeee;
        z-index: 2;
        position: fixed;
        top: 0px;
        left: 0px;
        margin-top: 74px;
    }

</style>

<div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" style="margin-top: 35px;" class="closebtn" onclick="closeNav()">×</a>
    <a href="tryhow_js_collapse_sidebar.php">&nbsp;</a>
    <a href="tryhow_js_collapse_sidebar.php">&nbsp;</a>
    <span><?php if ($model["tipe"] == 3) { ?>
            <h3 style="margin-left: 20px; color: #ffffff;">Привіт, <?php echo $model["username"]; ?>!</h3>
        <?php } ?>
        <?php if ($model["tipe"] == 2 or $model["tipe"] == 4) { ?>
            <h3 style="margin-left: 20px; color: #ffffff;">Ви, <?php echo $model["username"]; ?>!</h3>
        <?php } ?></span>
    <a href="/myroom/index">Кабінет</a>
    <a href="/site/instruction">Інструкція</a>
    <a href="/site/contact">Контакти</a>
    <span style="margin-top:70px; margin-left: 30px; position: absolute;"><form action="/site/logout" method="post">
        <input type="hidden" name="_csrf"
               value="QaN_NFqPAn_ylL9laHBY5MhaOr7lRWTyEOL_nqZ6vZko0TBxYupOGsLb9ylRKGud-hRX25UyEqslqav91y3y8g=="><button
                    type="submit" class="btn btn-danger"><svg width="1.3em" height="1.3em" viewBox="0 0 16 16"
                                                              class="bi bi-door-open" fill="currentColor"
                                                              xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM11.5 2H11V1h.5A1.5 1.5 0 0 1 13 2.5V15h-1V2.5a.5.5 0 0 0-.5-.5z"/>
                <path fill-rule="evenodd"
                      d="M10.828.122A.5.5 0 0 1 11 .5V15h-1V1.077l-6 .857V15H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117z"/>
                <path d="M8 9c0 .552.224 1 .5 1s.5-.448.5-1-.224-1-.5-1-.5.448-.5 1z"/>
               </svg>(ВИХІД)</button></form></span>
    <a href="">
        <input type="hidden" name="_csrf"
               value="TH57CrLPkvrYf-0VRtG4fbylOioJDEfcG8E1P7kku4QuN0hS4Zj1rZkGuEUog80v-p1dRDtLcKspr1sH-AmO5g==">
        <button type="submit" style="margin-top:12px;" class="btn btn-warning">Наш магазин&nbsp;&nbsp;&nbsp;&nbsp;<svg
                    width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
        </button>
    </a>
</div>
<div id="main">
    <button class="openbtn" onclick="openNav()">
        меню
    </button>
</div>
<center>
    <div class="modal fade" id="openModalJornalUser" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div style="width: 50%;" role="document">
            <div class="modal-content" style="background-color: #ffffff;">
                <div type="text" style="color: #0080FF; font-size: 0px;" id="uchenik_id"></div>
                <h5 class="modal-title" id="exampleModalLongTitleUser">&nbsp;&nbsp;&nbsp;<div
                            style="color: #0080FF; font-size: 20px;">Оцінування учня
                        <div type="text" style="color: #0080FF; font-size: 20px;" id="uchenik_name"></div>
                </h5>
                <div class="rasp" style="background-color: #ffffff;">
                    <div class="modal-body" id="responseOpenModalJornalUser"></div>
                    <span>Оберіть оцінку:&nbsp;
                    <select name="select" onchange="JurnalAddOcenka(this.value)" class="form-control"
                            style="width: 50%;"> <!--Supplement an id here instead of using 'name'-->
                        <option value="0" selected>0</option>
                        <option value="1">Значеня 1</option>
                        <option value="2">Значення 2</option>
                        <option value="3">Значення 3</option>
                        <option value="4">Значення 4</option>
                        <option value="5">Значення 5</option>
                        <option value="6">Значення 6</option>
                        <option value="7">Значення 7</option>
                        <option value="8">Значення 8</option>
                        <option value="9">Значення 9</option>
                        <option value="10">Значення 10</option>
                        <option value="11">Значення 11</option>
                        <option value="12">Значення 12</option>
                    </select></span>
                </div>
                <div class="modal-footer"
                     style="background-color: #ffffff; margin-top: 30px; background-color: #ffffff;">
                    <center>
                        <span>«Кожна дитина частково геній, а кожен геній частково дитина», - Артур Шопенгауер.</span>
                    </center>
                </div>
                <div class="modal-footer" style="background-color: #ffffff;">
                    <center>
                        <span></span>
                        <button type="button" class="btn btn-info" onclick="closeJornalOpenUser();"
                                data-dismiss="modal">Назад
                        </button>
                        <button type="button" class="btn btn-warning" onclick="closeJornalOpenUser();"
                                data-dismiss="modal">Записати
                        </button>
                        </span>
                    </center>
                </div>
            </div>
        </div>
    </div>
</center>
<center>
    <div class="modal fade" id="openModalJornal" role="dialog"
         aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div style="width: 50%;" role="document">
            <div class="modal-content" style="background-color: #007fff;">
                &nbsp;
                <h5 class="modal-title" id="exampleModalLongTitle">&nbsp;&nbsp;&nbsp;<span
                            style="color: #ffffff; font-size: 20px;">Журнал</span></h5>
                <div class="rasp" style="background-color: #ffffff;">
                    <div class="modal-body" id="responseOpenModalJornal"></div>
                </div>
                <div class="modal-footer" style="background-color: #ffffff;">
                    <center>
                        <button type="button" class="btn btn-danger" onclick="openModalIntervalDateTestsClose();"
                                data-dismiss="modal">Закрити
                        </button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</center>
<script>function openJornal() {
        var class_number = "5";
        var class_litera = "Б";
        var school_id = "1833";
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apijornal/openclassjornal?param_class_number=' + class_number + '&param_class_litera=' + class_litera + '&para_school_id=' + school_id, true);
        xhr.onload = function () {
            $("#openModalJornal").modal('show');

            document.getElementById("responseOpenModalJornal").innerHTML = this.responseText;
        };
        xhr.send(null);
    }

    function JurnalAddOcenka(ocenka) {
        var class_number = "5";
        var class_litera = "Б";
        var school_id = "1833";
        var code_uroka = $.urlParam('code');
        var uchenik_id = document.getElementById("uchenik_id").innerHTML;
        var ticher_id = $.urlParam('id');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apijornal/jornaladdocenka?uchenik_id=' + uchenik_id + '&ocenka=' + ocenka + '&code_uroka=' + code_uroka + '&ticher_id=' + ticher_id, true);
        xhr.onload = function () {
            alert("Оцінка додана :)");
            $("#openModalJornalUser").modal('hide');
            $("#openModalJornal").modal('show');
        };
        xhr.send(null);
    }

    function closeJornalOpenUser(user_id) {
        $("#openModalJornalUser").modal('hide');
        $("#openModalJornal").modal('show');

    }

    function openJornalUser(user_id) {
        $("#openModalJornal").modal('hide');
        $("#openModalJornalUser").modal('show');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apijornal/respondnameuchenik?user_uchenik=' + user_id, true);
        xhr.onload = function () {
            document.getElementById("uchenik_name").innerHTML = this.responseText;
        };
        xhr.send(null);
        document.getElementById("uchenik_id").innerHTML = user_id;
    }
</script>
<div class="modal fade" id="openModalTestsStart" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="modalTestsStart">
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalIntervalDateTestsClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="openModalIntervalDateTestsResponse" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #007fff;">
            &nbsp;
            <h5 class="modal-title" id="exampleModalLongTitle">&nbsp;&nbsp;&nbsp;<span
                        style="color: #ffffff; font-size: 20px;">Тести за
                        період</span></h5>
            <div class="rasp" style="background-color: #ffffff;">
                <div class="modal-body" id="modalIntervalDateTests"></div>
            </div>
            <div class="modal-footer" style="background-color: #ffffff;">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalIntervalDateTestsClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<script> function openModalTestsIntervalAll() {
        $("#openModalIntervalDateAllTest").modal('show');
    }

    function openModalTestsIntervalResponseAll() {
        $("#openModalIntervalDateAllTest").modal('toggle');
        $("#openModalIntervalDateTestsResponse").modal('show');
    }
</script>
<div class="modal fade bd-example-modal-sm" id="openModalIntervalDateAllTest" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <p class="modal-title" id="exampleModalLongTitle">Оберіть дату, або період</p>&nbsp;
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker10">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker21" class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker22" onchange="openModalTestsIntervalResponseAll()" ;
                                       class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" data-dismiss="modal" class="btn btn-danger" aria-label="Close">Закрити</button>
            </div>
        </div>
    </div>
</div>
<script>  function openModalTestsIntervalResponseAll() {
        var datepicker21 = document.getElementById('datepicker21').value;
        var datepicker22 = document.getElementById('datepicker22').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/testsallandnew?param1=' + datepicker21 + '&param2=' + datepicker22, true);
        xhr.onload = function () {
            $("#openModalIntervalDateAllTest").modal('toggle');
            $("#openModalIntervalDateTestsResponse").modal('show');
            document.getElementById("modalIntervalDateTests").innerHTML = this.responseText;
        };
        xhr.send(null);
    }</script>
<div class="modal fade bd-example-modal-sm" id="openModalIntervalDateTest" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <div class="form-group" style="margin-left:60px; margin-top:-30px;">
                </div>&nbsp; &nbsp;
                <p class="modal-title" id="exampleModalLongTitle">Створення тесту</p>&nbsp;
                <div class="row">
                    <div id='codevoprosa' style="display: none;"></div>
                    <div class="col-xs-6">
                        &nbsp; &nbsp;<svg width="1.7em" style="margin-top:-11px; margin-left:-14px;" height="1.7em"
                                          viewBox="0 0 16 16" class="bi bi-calendar-check" fill="currentColor"
                                          xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            <path fill-rule="evenodd"
                                  d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        </svg>&nbsp; &nbsp;

                        <div class="form-group" style="margin-top:-32px; margin-left:28px; ">

                            <div class="input-group date">

                                <input type="date" size="100"
                                       title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker14" class="form-control" style="size:100px;border-radius:5px;"/>
                            </div>
                        </div>
                    </div>
                    &nbsp; &nbsp;<svg width="1.7em" style="margin-top:10px;" height="1.7em" viewBox="0 0 16 16"
                                      class="bi bi-alarm" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                    </svg>&nbsp;
                    <div class="form-group" style="margin-left:60px; margin-top:-30px;">

                        <input list="number-list-time-respond" class="form-control"
                               style="margin-left:2px; margin-left:-20px;"
                               id="test_number_minute" placeholder="Час на відповідь (хвилини)"/>
                        <datalist id="number-list-time-respond">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option>30</option>
                        </datalist>
                    </div>&nbsp;<svg width="1.7em" style="margin-left:8px;" height="1.7em" viewBox="0 0 16 16"
                                     class="bi bi-door-closed" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                    </svg>
                    <div class="form-group" style="margin-left:60px; margin-top:-30px;">
                        <input list="number-list-predmet" class="form-control"
                               style="margin-left:2px; margin-left:-20px;"
                               id="test_number_id" onchange="RespondPredmet(this.value);" placeholder="Номер класу"/>
                        <datalist id="number-list-predmet">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </datalist>
                    </div>&nbsp; &nbsp;
                    <svg style="margin-top:2px;position: absolute;" width="1.4em" height="1.4em" viewBox="0 0 16 16"
                         class="bi bi-info-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path fill-rule="evenodd"
                              d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                        <circle cx="8" cy="4.5" r="1"/>
                    </svg>
                    <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                        <input list="number-list-latter" class="form-control"
                               style="margin-left:2px; margin-left:-20px;"
                               id="test_latter_id" placeholder="Літера класу"/>
                        <datalist id="number-list-latter">
                            <option value="А">А</option>
                            <option value="Б">Б</option>
                            <option value="В">В</option>
                            <option value="Г">Г</option>
                            <option value="Д">Д</option>
                            <option value="Ж">Ж</option>
                            <option value="З">З</option>
                        </datalist>
                    </div>
                    <div class="form-group">
                        &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.8em" height="1.8em"
                                          viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor"
                                          xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                            <input list="number-list-response-predmet" class="form-control"
                                   style="margin-left:2px; margin-left:-20px;" id="test_predmet" placeholder="Предмет"/>
                            <datalist id='number-list-response-predmet'>
                            </datalist>
                        </div>
                        &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.8em" height="1.8em"
                                          viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor"
                                          xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <div class="form-group" style="margin-left:40px; margin-top:-22px;">
                            <textarea class="form-control" id="test_text" rows="3"
                                      placeholder="Текст питання"></textarea>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Позначьте галкою відповідь !)
                    </div>
                    &nbsp;

                    <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                        <input id="chek1" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"> <input list="text"
                                                                                                      class="form-control"
                                                                                                      style="margin-left:2px; margin-left:-20px;"
                                                                                                      id="inputtest1"
                                                                                                      placeholder="Варіант відповіді a"/>
                        <input id="chek2" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"><input list="text"
                                                                                                     class="form-control"
                                                                                                     style="margin-left:2px; margin-left:-20px;"
                                                                                                     id="inputtest2"
                                                                                                     placeholder="Варіант відповіді b"/>
                        <input id="chek3" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"><input list="text"
                                                                                                     class="form-control"
                                                                                                     style="margin-left:2px; margin-left:-20px;"
                                                                                                     id="inputtest3"
                                                                                                     placeholder="Варіант відповіді c"/>
                        <input id="chek4" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"> <input list="text"
                                                                                                      class="form-control"
                                                                                                      style="margin-left:2px; margin-left:-20px;"
                                                                                                      id="inputtest4"
                                                                                                      placeholder="Варіант відповіді d"/>
                        <input id="chek5" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"> <input list="text"
                                                                                                      class="form-control"
                                                                                                      style="margin-left:2px; margin-left:-20px;"
                                                                                                      id="inputtest5"
                                                                                                      placeholder="Варіант відповіді e"/>
                        <input id="chek6" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"><input list="text"
                                                                                                     class="form-control"
                                                                                                     style="margin-left:2px; margin-left:-20px;"
                                                                                                     id="inputtest6"
                                                                                                     placeholder="Варіант відповіді f"/>
                        <input id="chek7" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"><input list="text"
                                                                                                     class="form-control"
                                                                                                     style="margin-left:2px; margin-left:-20px;"
                                                                                                     id="inputtest7"
                                                                                                     placeholder="Варіант відповіді g"/>
                        <input id="chek8" type="checkbox"
                               style="margin-top:9px;position: absolute; margin-left: -40px;"><input list="text"
                                                                                                     class="form-control"
                                                                                                     style="margin-left:2px; margin-left:-20px;"
                                                                                                     id="inputtest8"
                                                                                                     placeholder="Варіант відповіді i"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <?php
                        if (Yii::$app->user->id != 9 && Yii::$app->user->id != 10 && Yii::$app->user->id != 11) {
                            ?>
                            <button type="submit" class="btn btn-success" onclick="CreateTest();">Створити</button>
                        <?php } ?>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function TestOtvet(param1, param2, param3) {
        var variant_otveta = param1;
        var code = param2;
        var code_voprose = param3;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/testotvetvariantuser?param1=' + variant_otveta + '&param2=' + code + '&param3=' + code_voprose, true);
        xhr.onload = function () {
        };
        xhr.send(null);
        $("#openModalTestsStart").modal('show');
        $("#openModalIntervalDateTestsResponse").modal('hide');
        document.getElementById("modalTestsStart").innerHTML = "";
        TestClickOpenVariantUser();
    }

    function TestClickOpenVariantUser() {
        var code = document.getElementById('code_test').innerHTML;
        var date_value_van = document.getElementById("datepicker21").value;
        var date_value_thu = document.getElementById("datepicker22").value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/testsstart?param1=' + code + '&param2=' + date_value_van + '&param3=' + date_value_thu, true);
        xhr.onload = function () {
            document.getElementById("modalTestsStart").innerHTML = this.responseText;
        };
        xhr.send(null);
        $("#openModalIntervalDateTestsResponse").modal('hide');
        $("#openModalTestsStart").modal('show');
    }

    function TestClickOpen(code, code_voprosa) {
        // var code = document.getElementById('code_test').innerHTML;
        var date_value_van = document.getElementById("datepicker21").value;
        var date_value_thu = document.getElementById("datepicker22").value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/testsstart?param1=' + code + '&param2=' + date_value_van + '&param3=' + date_value_thu + '&code_voprosa=' + code_voprosa, true);
        xhr.onload = function () {
            document.getElementById("modalTestsStart").innerHTML = this.responseText;
        };
        xhr.send(null);
        $("#openModalTestsStart").modal('show');

        $("#openModalIntervalDateTestsResponse").modal('toggle');
    }

    function TestClickOpenResponseDuble(code, code_voprosa) {
        // var code = document.getElementById('code_test').innerHTML;
        var date_value_van = document.getElementById("datepicker21").value;
        var date_value_thu = document.getElementById("datepicker22").value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/testsstart?param1=' + code + '&param2=' + date_value_van + '&param3=' + date_value_thu + '&code_voprosa=' + code_voprosa, true);
        xhr.onload = function () {
            document.getElementById("modalTestsStart").innerHTML = this.responseText;
        };
        xhr.send(null);
    }

    function TestClickOpenDuble(code) {
        //var code = document.getElementById('code_test').innerHTML;
        var date_value_van = document.getElementById("datepicker21").value;
        var date_value_thu = document.getElementById("datepicker22").value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/testsstartduble?param1=' + code + '&param2=' + date_value_van + '&param3=' + date_value_thu, true);
        xhr.onload = function () {
            document.getElementById("modalTestsStart").innerHTML = this.responseText;
        };
        xhr.send(null);
        $("#openModalTestsStart").modal('show');
    }

    function CreateTest() {
        var codevoprosarespond = document.getElementById('codevoprosa').value;
        var test_date_data = document.getElementById('datepicker14').value;
        var test_number_class_data = document.getElementById('test_number_id').value;
        var test_latter_class_data = document.getElementById('test_latter_id').value;
        var test_predmet_data = document.getElementById('test_predmet').value;
        var test_number_minute = document.getElementById('test_number_minute').value;
        var test_text = document.getElementById('test_text').value;
        var test_input1 = document.getElementById('inputtest1').value;
        var test_input2 = document.getElementById('inputtest2').value;
        var test_input3 = document.getElementById('inputtest3').value;
        var test_input4 = document.getElementById('inputtest4').value;
        var test_input5 = document.getElementById('inputtest5').value;
        var test_input6 = document.getElementById('inputtest6').value;
        var test_input7 = document.getElementById('inputtest7').value;

        var chbox1;
        chbox1 = document.getElementById('chek1');
        if (chbox1.checked) {
            var test_chek1 = document.getElementById('chek1').value = 1;
        }
        var chbox2;
        chbox2 = document.getElementById('chek2');
        if (chbox2.checked) {
            var test_chek2 = document.getElementById('chek2').value = 1;
        }
        var chbox3;
        chbox3 = document.getElementById('chek3');
        if (chbox3.checked) {
            var test_chek3 = document.getElementById('chek3').value = 1;
        }
        var chbox4;
        chbox4 = document.getElementById('chek4');
        if (chbox4.checked) {
            var test_chek4 = document.getElementById('chek4').value = 1;
        }
        var chbox5;
        chbox5 = document.getElementById('chek5');
        if (chbox5.checked) {
            var test_chek5 = document.getElementById('chek5').value = 1;
        }
        var chbox6;
        chbox6 = document.getElementById('chek6');
        if (chbox6.checked) {
            var test_chek6 = document.getElementById('chek6').value = 1;
        }
        var chbox7;
        chbox7 = document.getElementById('chek7');
        if (chbox7.checked) {
            var test_chek7 = document.getElementById('chek7').value = 1;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apitesti/createtest?parametr1=' + test_date_data + '&parametr2='
            + test_number_class_data + '&parametr3=' + test_latter_class_data + '&parametr4='
            + test_predmet_data + '&parametr5=' + test_text + '&parametr6='
            + test_input1 + '&parametr7=' + test_input2 + '&parametr8='
            + test_input3 + '&parametr9=' + test_input4 + '&parametr10='
            + test_input5 + '&parametr11=' + test_input6 + '&parametr12='
            + test_input7 + '&parametr13=' + test_chek1 + '&parametr14='
            + test_chek2 + '&parametr15=' + test_chek3 + '&parametr16='
            + test_chek4 + '&parametr17=' + test_chek5 + '&parametr18='
            + test_chek6 + '&parametr19=' + test_chek7 + '&parametr20=' + test_number_minute, true);
        xhr.onload = function () {
            var obj = JSON.parse(this.responseText);
            var codvoprosatestotvet = obj.code;
            document.getElementById("codevoprosa").innerHTML = codvoprosatestotvet;
            openModalTestCreate();
            if (obj.code != false) {
                alert(test_number_minute);
            }
        };
        xhr.send(null);
    }
</script>
<div class="modal fade" id="messageModalTestCreate" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="alert alert-success" role="alert">
            Тест створено ! Продовжити ? ...
            &nbsp;
            <p>
                <button type="button" class="btn btn-success" onclick="openModalTestCreate()" data-dismiss="modal">Так
                </button>
                <button type="button" class="btn btn-danger" onclick="" data-dismiss="modal">Ні</button>
            </p>
        </div>
    </div>
</div>
<script>
    function openModalTestCreate(codvoprosatestotvet) {
        $("#openModalIntervalDateTest").modal('toggle');
        $("#messageModalTestCreate").modal('show');

        document.getElementById('test_text').value = "";
        document.getElementById('inputtest1').value = "";
        document.getElementById('inputtest2').value = "";
        document.getElementById('inputtest3').value = "";
        document.getElementById('inputtest4').value = "";
        document.getElementById('inputtest5').value = "";
        document.getElementById('inputtest6').value = "";
        document.getElementById('inputtest7').value = "";
        document.getElementById('chek1').checked = false;
        document.getElementById('chek2').checked = false;
        document.getElementById('chek3').checked = false;
        document.getElementById('chek4').checked = false;
        document.getElementById('chek5').checked = false;
        document.getElementById('chek6').checked = false;
        document.getElementById('chek7').checked = false;
    }
</script>
<div class="modal fade" id="openModalIntervalDateDZResponse" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #007fff;">
            &nbsp;
            <h5 class="modal-title" id="exampleModalLongTitle">&nbsp;&nbsp;&nbsp;<span
                        style="color:#ffffff; font-size:20px;">Д/З за
                    період</span></h5>
            <div class="rasp" style="background-color: #ffffff; overflow-x: hidden;">
                <div class="modal-body" id="modalIntervalDate">
                </div>
            </div>
            <div class="modal-footer" style="background-color: #ffffff;">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalIntervalDateDZClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-sm" id="openModalIntervalDateDZ" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <h5 class="modal-title" id="exampleModalLongTitle">Оберіть інтервал дат</h5>
                &nbsp;
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker1" class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker2" onchange="IntervalDateDZ();" class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" data-dismiss="modal" class="btn btn-danger" aria-label="Close">Закрити</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="openModalIntervalDateDZResponse" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            &nbsp;
            <h5 class="modal-title" id="exampleModalLongTitle">&nbsp;&nbsp;&nbsp; Д/З за
                період</h5>
            <div class="rasp">
                <div class="modal-body" id="modalIntervalDate">
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalIntervalDateDZClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-sm" id="openModalIntervalDateRaspisanie" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <h5 class="modal-title" id="exampleModalLongTitle">Оберіть інтервал дат розкладу</h5>&nbsp;
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker3" class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker4" onchange="IntervalDateRaspisanie();"
                                       class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Закрити</button>
            </div>
        </div>
    </div>
</div>
<style>
    .vnd {
        font-weight: 700;
        color: white;
        text-decoration: none;
        padding: .4em 1em calc(.4em + 3px);
        border-radius: 3px;
        background: rgb(64, 199, 129);
        box-shadow: 0 -3px rgb(53, 167, 110) inset;
        transition: 0.2s;
    }

    .vnd:hover {
        background: rgb(53, 167, 110);
    }

    .vnd:active {
        background: rgb(33, 147, 90);
        box-shadow: 0 3px rgb(33, 147, 90) inset;
    }

</style>
<div class="modal fade" id="openModalIntervalDateRaspisanieResponse" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #007fff;">&nbsp;
            <h5 class="modal-title ">&nbsp;&nbsp;&nbsp;<span
                        style="color: #ffffff; font-size: 20px;">Розклад за період</span></h5>
            <div class="rasp" style="background-color: #ffffff; overflow-x: hidden;">
                <div class="modal-body" id="modalIntervalDateRaspisanie">
                </div>
            </div>
            <div class="modal-footer" style="background-color: #ffffff;">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalIntervalDateRaspisanieClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" id="openModalIntervalDateRaspisanieInterval" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
            <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                <h5 class="modal-title" id="exampleModalLongTitle">Оберіть інтервал дат </h5>&nbsp;
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker2">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker6" class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="datepicker7" onchange="IntervalDateRedactRaspisanie();"
                                       class="form-control"/>
                                <span class="input-group-addon">Дата</span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Закрити</button>
            </div>
        </div>
    </div>
</div>
<style>
    .rasp {
        overflow: scroll;
        height: 550px;
        padding: 0px;
    }
</style>
<div class="modal fade" id="openModalIntervalDateRaspisanieResponseRedact" tabindex="-1" role="dialog"
     data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="list-group">
                <span class="list-group-item active">Список в інтервалі дат рр</span>
                <div class="rasp" style="background-color: #ffffff; overflow-x: hidden;">
                    &nbsp;
                    <div class="alert alert-danger" role="alert">
                        Увага! Створений розклад не редагується, а деактивується ...
                    </div>
                    <span id="open_redact_raspisanie_interval"></span>
                </div>
                <div class="modal-footer" style="background-color: #ffffff;">
                    <center>
                        <button type="button" lass="close" class="btn btn-danger"
                                data-dismiss="modal" aria-label="Close">Закрити
                        </button>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function IntervalDateRedactRaspisanie() {
        $("#openModalIntervalDateRaspisanieInterval").modal('toggle');
        $("#openModalIntervalDateRaspisanieResponseRedact").modal('show');
        var user_id = <?php  echo $id ?>;
        var datepicker6 = document.getElementById('datepicker6').value;
        var datepicker7 = document.getElementById('datepicker7').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apirozklad/intervaldateraspisanie?parametr1=zavuch&parametr2=' + datepicker6 + '&parametr3=' + datepicker7, true);
        xhr.onload = function () {

            document.getElementById("open_redact_raspisanie_interval").innerHTML = this.responseText;
        };
        xhr.send(null);
    }
</script>
<div class="modal fade" id="openModalIntervalDateRaspisanieResponseAdmin" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">&nbsp;
            <h5 class="modal-title ">&nbsp;&nbsp;&nbsp;Розклад за період</h5>
            <div class="rasp">
                <div class="modal-body" id="modalIntervalDateRaspisanieResponseAdmin">
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalIntervalDateRaspisanieAdminClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-sm" id="openModalAddUser" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">&nbsp;
            <h5 class="modal-title">&nbsp;Введіть І'мя, Прізвище, по батькові вчителя</h5>
            <p><input class="form-control" style=" "
                      id="add_user_firstname" placeholder="Прізвище"/></p>
            <p><input class="form-control" style=" "
                      id="add_user_lastname" placeholder="І'мя"/></p>
            <p><input class="form-control" style=" "
                      id="add_user_otchestvo" placeholder="По батькові"/></p>
            <p><input class="form-control" style=" "
                      id="add_user_email" placeholder="e-mail вчителя"/></p>

            <input class="form-control" id="dataticheradd0" onchange="AddTicherPredmet(0);" list="list-ticher0" style=""
                   placeholder="Предмет"/>
            <datalist id="list-ticher0">
                <option>Українська мова</option>
                <option>Літературне читання</option>
                <option>Англійська мова</option>
                <option>Я у світі</option>
                <option>Музичне мистецтво</option>
                <option>Образотворче мистецтво</option>
                <option>Математика</option>
                <option>Природознавство</option>
                <option>Трудове навчання</option>
                <option>Информатика</option>
                <option>Основи здоров'я</option>
                <option>Російська мова</option>
                <option>Фізична культура</option>
                <option>Історія (Введення в історію)</option>
                <option>Німецька мова</option>
                <option>Польська мова</option>
                <option>Історія України і всесвітня історія</option>
                <option>Біологіия</option>
                <option>Географія</option>
                <option>Іноземна література</option>
                <option>Історія України</option>
                <option>Всесвітня історія</option>
                <option>Алгебра</option>
                <option>Хімія</option>
                <option>Геометрія</option>
                <option>Українська література</option>
                <option>Основи правоведення</option>
                <option>Мат.(Алгебра і початки аналізу та геометрія)</option>
                <option>Фізика і астрономія</option>
                <option>Біологіия і екологія</option>
                <option>Захист Украіни</option>
            </datalist>
            </p>
            <p><span id="add_ticher_predmet1"></span></p>
            <p><span id="add_ticher_predmet2"></span></p>
            <p><span id="add_ticher_predmet3"></span></p>
            <p><span id="add_ticher_predmet4"></span></p>
            <p><span id="add_ticher_predmet5"></span></p>
            <p><span id="add_ticher_predmet6"></span></p>
            <p><span id="add_ticher_predmet7"></span></p>
            <p><span id="add_ticher_predmet8"></span></p>
            <p><span id="add_ticher_predmet9"></span></p>
            <p><span id="add_ticher_predmet10"></span></p>
            <p><span id="add_ticher_predmet11"></span></p>
            <p><span id="add_ticher_predmet12"></span></p>

            <div class="modal-footer">
                <center>
                    <?php
                    if (Yii::$app->user->id != 9 && Yii::$app->user->id != 10 && Yii::$app->user->id != 11) {
                        ?>
                        <button type="submit" class="btn btn-success" onclick="CreateUser();">Додати</button>
                    <?php } ?>
                    <button type="button" class="btn btn-primary" onclick="openModalTest();"
                            data-dismiss="modal">Отмена
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<script>
    function AddTicherPredmet(ididentify) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/namepredmetticheradd?identifi=' + ididentify, true);
        xhr.onload = function () {
            if (ididentify == 0) {
                document.getElementById("add_ticher_predmet1").innerHTML = this.responseText;
            }
            if (ididentify == 1) {
                document.getElementById("add_ticher_predmet2").innerHTML = this.responseText;
            }
            if (ididentify == 2) {
                document.getElementById("add_ticher_predmet3").innerHTML = this.responseText;
            }
            if (ididentify == 3) {
                document.getElementById("add_ticher_predmet4").innerHTML = this.responseText;
            }
            if (ididentify == 4) {
                document.getElementById("add_ticher_predmet5").innerHTML = this.responseText;
            }
            if (ididentify == 5) {
                document.getElementById("add_ticher_predmet6").innerHTML = this.responseText;
            }
            if (ididentify == 6) {
                document.getElementById("add_ticher_predmet7").innerHTML = this.responseText;
            }
            if (ididentify == 7) {
                document.getElementById("add_ticher_predmet8").innerHTML = this.responseText;
            }
            if (ididentify == 8) {
                document.getElementById("add_ticher_predmet9").innerHTML = this.responseText;
            }
            alert(2342342);
        }
        xhr.send(null);
    }
</script>
<div class="modal fade" id="openModalUserSelect" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">&nbsp;
            <h5 class="modal-title">&nbsp;&nbsp;&nbsp;Вчетелі вашої школи </h5>
            <div class="rasp">
                <div class="modal-body" id="open_respond_user">
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-danger" onclick=""
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<script>
    function openModalUserAdmin() {
        $("#openModalUserSelect").modal('show');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/responseusers', true);
        xhr.onload = function () {
            document.getElementById("open_respond_user").innerHTML = this.responseText;
        }
        xhr.send(null);
    }
</script>
<script>
    function openModalIntervalDateResultTest() {
        $("#openModalTestsResultati").modal('show');
    }

    function openModalIntervalDateTest() {
        $("#openModalIntervalDateTest").modal('show');
    }

    function openModalIntervalDateRedactRaspisanie() {

        $("#openModalIntervalDateRaspisanieInterval").modal('show');
        $("#messageModalRaspisanieCreateNo").modal('hide');
    }

    function openModalIntervalDate() {
        $("#openModalIntervalDateDZ").modal('show');
    }

    function openModalIntervalDateDZClose() {
        $("#openModalIntervalDateDZ").modal('show');
    }

    function IntervalDateDZ() {
        <?php if ($model["tipe"] == 2 ) { ?>
        var user_id = <?php  echo $id ?>;
        var datepicker1 = document.getElementById('datepicker1').value;
        var datepicker2 = document.getElementById('datepicker2').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apidz/intervaldatedz?parametr1=' + user_id + '&parametr2=' + datepicker1 + '&parametr3=' + datepicker2, true);
        xhr.onload = function () {
            document.getElementById("modalIntervalDate").innerHTML = this.responseText;
            $("#openModalIntervalDateDZ").modal('toggle');
            $("#openModalIntervalDateDZResponse").modal('show');
        };
        xhr.send(null);
        <?php }?>
        <?php if ($model["tipe"] == 3 ) { ?>
        var datepicker1 = document.getElementById('datepicker1').value;
        var datepicker2 = document.getElementById('datepicker2').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apidz/intervaldatedz?parametr1=uchenic&parametr2=' + datepicker1 + '&parametr3=' + datepicker2, true);
        xhr.onload = function () {
            document.getElementById("modalIntervalDate").innerHTML = this.responseText;
            $("#openModalIntervalDateDZ").modal('toggle');
            $("#openModalIntervalDateDZResponse").modal('show');
        };
        xhr.send(null);
        <?php }?>
    }

    function openModalIntervalDateRaspisanie() {
        $("#openModalIntervalDateRaspisanie").modal('show');
    }

    function openModalIntervalDateRaspisanieClose() {
        $("#openModalIntervalDateRaspisanie").modal('show');
    }

    function openModalIntervalDateRaspisanieAdminClose() {
        $("#openRedactRaspisanie").modal('show');
    }

    function IntervalDateRaspisanie() {
        <?php if ($model["tipe"] == 2 ) { ?>
        var user_id = <?php  echo $id ?>;
        var datepicker1 = document.getElementById('datepicker3').value;
        var datepicker2 = document.getElementById('datepicker4').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apirozklad/intervaldateraspisanie?parametr1=' + user_id + '&parametr2=' + datepicker1 + '&parametr3=' + datepicker2, true);
        xhr.onload = function () {
            document.getElementById("modalIntervalDateRaspisanie").innerHTML = this.responseText;
            $("#openModalIntervalDateRaspisanie").modal('toggle');
            $("#openModalIntervalDateRaspisanieResponse").modal('show');
        };
        xhr.send(null);
        <?php }?>
        <?php if ($model["tipe"] == 3 ) { ?>

        var datepicker1 = document.getElementById('datepicker3').value;
        var datepicker2 = document.getElementById('datepicker4').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apirozklad/intervaldateraspisanie?parametr1=uchenic&parametr2=' + datepicker1 + '&parametr3=' + datepicker2, true);
        xhr.onload = function () {
            document.getElementById("modalIntervalDateRaspisanie").innerHTML = this.responseText;
            $("#openModalIntervalDateRaspisanie").modal('toggle');
            $("#openModalIntervalDateRaspisanieResponse").modal('show');
        };
        xhr.send(null);
        <?php }?>
    }
</script>
<div class="modal fade" id="openWindowAdmin" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <div class="alert alert-warning" role="alert">
            Ця функція в розробці ...
        </div>
    </div>
</div>
<script>
    function openWindowAdmin() {
        $("#openWindowAdmin").modal('show');
    }
</script>
<div class="modal fade" id="openRepetitor" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <div class="alert alert-warning" role="alert">
            Ця функція в розробці ...
        </div>
    </div>
</div>
<script>
    function openModalRepetitor() {
        $("#openRepetitor").modal('show');
    }
</script>
<div class="modal fade" id="openRedactRaspisanie" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="list-group">
                <span class="list-group-item active">Розклад на: </span>
                <span id="open_redact_raspisanie"></span>
            </div>
        </div>
    </div>
</div>
<script>
    function openModalRedactRaspisanie() {
        $("#openRedactRaspisanie").modal('show');
    }
</script>
<div class="modal fade" id="openModalRaspisanie" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="list-group">
            <span class="list-group-item active">Розклад на: </span>
            <span id="open_respond_raspisanie"></span>
        </div>
    </div>
</div>
<script>
    function openModalRaspisanie() {
        $("#openModalRaspisanie").modal('show');
    }
</script>
<div class="modal fade" id="openModalDz" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #007fff;">&nbsp;
            <h5 class="modal-title " style="background-color: #007fff; font-size: 18px; color: #ffffff;">&nbsp;&nbsp;&nbsp;Д/З
                на обрану дату</h5>
            <div class="rasp" style="background-color: #ffffff;">
                <div class="modal-body" id="open_dz_raspisanie">
                </div>
            </div>
            <div class="modal-footer" style="background-color: #ffffff;">
                <center>
                    <button type="button" class="btn btn-danger" onclick="openModalDZClose();"
                            data-dismiss="modal">Закрити
                    </button>
                </center>
            </div>
        </div>
    </div>
</div>
<script>
    function openModalDZ() {
        $("#openModalDz").modal('show');
    }

    function openModalDZClose() {
        $("#openModalDz").modal('hide');
    }
</script>
<div class="modal fade" id="messageModalRaspisanieCreate" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="alert alert-success" role="alert">
            <p>Запис створено! Продовжити ?...</p>
            <p>
                <button type="button" class="btn btn-success" onclick="openModalRaspisanieCreateElse()"
                        data-dismiss="modal">Так
                </button>
                <button type="button" class="btn btn-danger" onclick="" data-dismiss="modal">Ні</button>
            </p>
        </div>
    </div>
</div>
<script>
    function openModalRaspisanieCreate() {
        $("#messageModalRaspisanieCreate").modal('show');
    }

    function openModalRaspisanieCreateElse() {
        document.getElementById('rasp_time').value = "";
        document.getElementById('rasp_date').value = "";
        document.getElementById('rasp_number').value = "";
        document.getElementById('rasp_latter').value = "";
        document.getElementById('rasp_predmet').value = "";
        document.getElementById('rasp_ticher_add').value = "";
        $("#messageModalRaspisanieCreate").modal('toggle');
        $("#formaCreateRaspisanie").modal('show');
    }
</script>
<div class="modal fade" id="messageModalRaspisanieCreateNo" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="alert alert-warning" role="alert">
            У цього класа в цей час вже є урок, оберіть другий час !
            <p><a href="#" onclick="openModalIntervalDateRedactRaspisanie();">Подивитись розклад</a></p>
            <p>
                <button type="button" class="btn btn-success" onclick="openModalRaspisanieClose()" data-dismiss="modal">
                    Ok
                </button>
                <button type="button" class="btn btn-danger" onclick="" data-dismiss="modal">Ні</button>
            </p>
        </div>
    </div>
</div>
<script>
    function openModalRaspisanieCreateNo() {
        $("#messageModalRaspisanieCreateNo").modal('show');
    }

    function openModalRaspisanieClose() {
        $("#formaCreateRaspisanie").modal('show');
        openModalRaspisanieCreateNo();
    }
</script>
<div class="modal fade" id="messageModalUsersCreate" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p> Запис створено! Продовжити ? ...</p>
            <button type="button" class="btn btn-success" onclick="OpenModalAddUser()" data-dismiss="modal">Так</button>
            <button type="button" class="btn btn-danger" onclick="" data-dismiss="modal">Ні</button>
        </div>
    </div>
</div>
<div class="modal fade" id="messageModalDZCreate" tabindex="-1" data-toggle="modal">
    <div class="modal-dialog" role="document">
        <div class="alert alert-success" role="alert">
            Д/З створено !
        </div>
    </div>
</div>
<script>
    function openModalDZCreate() {
        $("#messageModalDZCreate").modal('show');
    }
</script>
<div class="modal fade create-raspisanie" id="formaCreateRaspisanie" data-toggle="modal" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
            </center>

            <br>
            &nbsp; &nbsp;&nbsp;<svg style="margin-top:3px;position: absolute;" width="1.5em" height="1.5em"
                                    viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
            </svg> &nbsp; &nbsp;&nbsp;
            <div class="form-group" style="margin-left:60px; margin-top:-22px;"><input class="form-control"
                                                                                       style="margin-left:2px; margin-left:-20px;"
                                                                                       id="rasp_time" type="time"
                                                                                       placeholder="Оберіть час"></input>
            </div>&nbsp; &nbsp;
            <svg style="margin-top:3px;position: absolute;" width="1.5em" viewBox="0 0 16 16" height="1.5em"
                 class="bi bi-calendar2-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                <path fill-rule="evenodd"
                      d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg> &nbsp; &nbsp; &nbsp;<div class="form-group" style="margin-left:60px; margin-top:-22px;"><input
                        class="form-control" style="margin-left:2px; margin-left:-20px;" id="rasp_date" type="date"
                        placeholder="Оберіть дату"></input>
            </div>
            &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.7em" viewBox="0 0 16 16"
                              height="1.7em" class="bi bi-door-closed" fill="currentColor"
                              xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
            </svg>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
            <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                <input list="number-list-predmet" class="form-control" style="margin-left:2px; margin-left:-20px;"
                       id="rasp_number" onchange="RespondPredmet(this.value);" placeholder="Номер класу"/>
                <datalist id="number-list-predmet">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                </datalist>
            </div>&nbsp; &nbsp;
            <svg style="margin-top:2px;position: absolute;" width="1.4em" height="1.4em" viewBox="0 0 16 16"
                 class="bi bi-info-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                <circle cx="8" cy="4.5" r="1"/>
            </svg>
            <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                <input list="number-list-latter" class="form-control" style="margin-left:2px; margin-left:-20px;"
                       id="rasp_latter" onchange="TicherRespondPredmet();" placeholder="Літера класу"/>
                <datalist id="number-list-latter">
                    <option value="А">А</option>
                    <option value="Б">Б</option>
                    <option value="В">В</option>
                    <option value="Г">Г</option>
                    <option value="Д">Д</option>
                    <option value="Ж">Ж</option>
                    <option value="З">З</option>
                </datalist>
            </div>
            <div class="form-group">
                &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.8em" height="1.8em"
                                  viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor"
                                  xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                    <input list="number-list-response-predmet" class="form-control"
                           style="margin-left:2px; margin-left:-20px;" id="rasp_predmet" placeholder="Предмет"/>
                    <datalist id='number-list-response-predmet'>
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                &nbsp;
                <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
                <div class="form-group" style="margin-left:60px; margin-top:-34px;">
                    <input list="ticher-add" class="form-control"
                           style="margin-left:2px; margin-left:-20px;" id="rasp_ticher_add" placeholder="Вчитель"/>
                    <datalist id='ticher-add'>
                    </datalist>
                </div>
            </div>
            <div class="modal-footer">
                <center>
                    <?php
                    if (Yii::$app->user->id != 9 && Yii::$app->user->id != 10 && Yii::$app->user->id != 11) {
                        ?>
                        <span id="hash"></span>

                    <?php } ?>
                </center>
            </div>
        </div>
    </div>
</div>
<script>
    function CreateRaspisanie(hash = null) {
        var response_hash = hash;
        var rasp_time_data = document.getElementById('rasp_time').value;
        var rasp_date_data = document.getElementById('rasp_date').value;
        var rasp_number_class_data = document.getElementById('rasp_number').value;
        var rasp_latter_class_data = document.getElementById('rasp_latter').value;
        var rasp_predmet_data = document.getElementById('rasp_predmet').value;
        var rasp_ticher_add_data = document.getElementById('rasp_ticher_add').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apirozklad/raspisanie?parametr1=create&parametr2=' + rasp_time_data + '&parametr3=' + rasp_date_data + '&parametr4=' + rasp_number_class_data + '&parametr5=' + rasp_latter_class_data + '&parametr6=' + rasp_predmet_data + '&parametr7=' + rasp_ticher_add_data + '&hash=' + hash, true);
        xhr.onload = function () {
            var obj = JSON.parse(this.responseText);
            console.log(this.responseText);
            if (this.responseText == 0) {

                openModalRaspisanieCreate();
                closeModalRaspisanieCreate();
            }

            if (this.responseText == 1) {

                openModalRaspisanieCreateNo();
                closeModalRaspisanieCreate();
            }
            if (this.responseText == 2) {

                alert("Неможна додавати розклад на дату та час які меньші за поточні дату та час !");
            }
        };
        xhr.send(null);
    }

    function closeModalRaspisanieCreate() {
        $("#formaCreateRaspisanie").modal('toggle');
    }
</script>
<div class="modal fade create-dz" id="formaCreateDZ" data-toggle="modal" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
            </center>
            <br>
            &nbsp; &nbsp;&nbsp;<svg style="margin-top:3px;position: absolute;" width="1.5em" height="1.5em"
                                    viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
            </svg> &nbsp; &nbsp;&nbsp;
            <div class="form-group" style="margin-left:60px; margin-top:-22px;"><input class="form-control"
                                                                                       style="margin-left:2px; margin-left:-20px;"
                                                                                       id="dz_time" type="time"
                                                                                       placeholder="Оберіть час"></input>
            </div>&nbsp; &nbsp;
            <svg style="margin-top:3px;position: absolute;" width="1.5em" viewBox="0 0 16 16" height="1.5em"
                 class="bi bi-calendar2-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                <path fill-rule="evenodd"
                      d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg> &nbsp; &nbsp; &nbsp;<div class="form-group" style="margin-left:60px; margin-top:-22px;"><input
                        class="form-control" style="margin-left:2px; margin-left:-20px;" id="dz_date" type="date"
                        placeholder="Оберіть дату"></input>
            </div>
            &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.7em" viewBox="0 0 16 16"
                              height="1.7em" class="bi bi-door-closed" fill="currentColor"
                              xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
            </svg>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
            <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                <input list="number-list-predmet" class="form-control" style="margin-left:2px; margin-left:-20px;"
                       id="dz_number" onchange="RespondPredmet(this.value);" placeholder="Номер класса"/>
                <datalist id="number-list-predmet">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                </datalist>
            </div>&nbsp; &nbsp;
            <svg style="margin-top:2px;position: absolute;" width="1.4em" height="1.4em" viewBox="0 0 16 16"
                 class="bi bi-info-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path fill-rule="evenodd"
                      d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                <circle cx="8" cy="4.5" r="1"/>
            </svg>
            <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                <input list="number-list-latter" class="form-control" style="margin-left:2px; margin-left:-20px;"
                       id="dz_latter" placeholder="Буква класса"/>
                <datalist id="number-list-latter">
                    <option value="А">А</option>
                    <option value="Б">Б</option>
                    <option value="В">В</option>
                    <option value="Г">Г</option>
                    <option value="Д">Д</option>
                    <option value="Ж">Ж</option>
                    <option value="З">З</option>
                </datalist>
            </div>
            <div class="form-group">
                &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.8em" height="1.8em"
                                  viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor"
                                  xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <div class="form-group" style="margin-left:60px; margin-top:-22px;">
                    <input list="number-list-response-predmet" class="form-control"
                           style="margin-left:2px; margin-left:-20px;" id="dz_predmet" placeholder="Предмет"/>
                    <datalist id='number-list-response-predmet'>
                    </datalist>
                </div>
            </div>
            <div class="form-group">
                &nbsp; &nbsp;<svg style="margin-top:2px;position: absolute;" width="1.8em" height="1.8em"
                                  viewBox="0 0 16 16" class="bi bi-justify" fill="currentColor"
                                  xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <div class="form-group" style="margin-left:40px; margin-top:-22px;">
                    <textarea class="form-control" id="dz_text" rows="3" placeholder="Текст Д/З"></textarea>
                </div>
            </div>
            <br>
            <div class="modal-footer">
                <center>
                    <?php

                    if (Yii::$app->user->id != 9 && Yii::$app->user->id != 10 && Yii::$app->user->id != 11) {
                        ?>
                        <span id="hashdz"></span>
                    <?php } ?>
                </center>
            </div>
        </div>
    </div>
</div>
<script>
    function CreateDZ(hash) {
        var response_hash_dz = hash;
        var dz_time_data = document.getElementById('dz_time').value;
        var dz_date_data = document.getElementById('dz_date').value;
        var dz_number_class_data = document.getElementById('dz_number').value;
        var dz_latter_class_data = document.getElementById('dz_latter').value;
        var dz_predmet_data = document.getElementById('dz_predmet').value;
        var dz_text_data = document.getElementById('dz_text').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/apidz/dz?parametr2=' + dz_time_data + '&parametr3=' + dz_date_data + '&parametr4=' + dz_number_class_data + '&parametr5=' + dz_latter_class_data + '&parametr6=' + dz_predmet_data + '&parametr7=' + dz_text_data + '&hash=' + response_hash_dz, true);
        xhr.onload = function () {
            if (this.responseText == 0) {
                alert("Всі поля обов`язкові до заповнення");
            } else {
                openModalDZCreate();
                closeModalDZCreate();
            }

        };
        xhr.send(null);
    }

    function closeModalDZCreate() {
        $("#formaCreateDZ").modal('toggle');
    }
</script>
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
        <div class="list-group">
            <?php if ($model["tipe"] != 4) { ?>
                <span style="background-color: dodgerblue; border-radius: 5px; position: relative;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
    background-color: #4169E1;
    border: 1px solid #ddd; color: #ffffff; margin-top: 3px; font-size: 19px;">&nbsp;Розклад на: <?php echo $today = date("d.m.Y"); ?>&nbsp;</span>
            <?php } ?>
            <?php if ($model["tipe"] == 4) { ?>
            <?php } ?>
            <?php if ($model["tipe"] != 4) { ?>
                <a href="online" class="list-group-item">
                    <span></span></a>
            <?php } ?>
            <?php if ($model["tipe"] == 3 or $model["tipe"] == 2) { ?>
                <?php
                if (empty($uroki)) {
                    if ($model["tipe"] == 2) {
                        echo " <span class='list-group-item'><span style='; border-radius: 5px; color:#000000;'>Поки нічого немає :(<br>При додаванні розкладу, він з'явиться тут на сьогоднішню дату</span></span>";
                    }
                }
                if (empty($uroki)) {
                    if ($model["tipe"] == 3) {
                        echo " <span class='list-group-item'><span style='; border-radius: 5px; color:#000000;'>Поки нічого нема :(<br>Як тільки для вашого класу буде створений розклад, ви автоматично отримаєтє повідомлення </span></span>";
                    }
                }
                if (!empty($uroki)) {
                    foreach ($uroki as $value) {
                        $rest = substr($value["time"], 0, 5);
                        echo " <span class='list-group-item'><span style='background-color: #1e7e34; border-radius: 5px; color:#ffffff;'>&nbsp; " . $rest . "&nbsp;</span> - " . $value["name_predmet"] . "</span>";
                    }
                }
                ?>
                <span class="list-group-item"></span>
                <script>
                    function ResponseRaspisanie() {
                        var rasp_respond_date = document.getElementById('rasp_respond_date').value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'https://e-osvita.online/apirozklad/responseraspisanie?parametr1=' + rasp_respond_date + '&parametr2=respond');
                        xhr.onload = function () {
                            //var obj = JSON.parse(this.responseText);
                            console.log(this.responseText);
                            document.getElementById("respond_raspisanie").innerHTML = this.responseText;
                            openModalRaspisanie();
                        };
                        xhr.send(null);
                    }
                </script>
            <?php } ?>
            <?php if ($model["tipe"] == 4 or $model["tipe"] == 1 or $model["tipe"] == 2) { ?>
                <button style="width:100%; border: 1px solid #c0c0c0; font-size:16px;" class="openbtn" data-toggle="modal"
                        data-target=".create-raspisanie"><span style="margin-left: -6px;">Додати розклад</span>
                </button>
            <?php } ?>
            <?php if ($model["tipe"] == 4 or $model["tipe"] == 1) { ?>
                <button type="button" style="width:100%; font-size:16px;" onclick="openWindowAdmin();"
                        class="btn btn-info"><span
                            style="margin-left: -26px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-shield-shaded"
                                                             viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M8 14.933a.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067v13.866zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                    </svg>&nbsp;&nbsp;&nbsp;&nbsp;Адмін
                        розділ</span>
                </button>
                <div class="dropdown">
                    <button class="openbtn dropdown-toggle" style="width:100%; border: 1px solid #c0c0c0; font-size:16px;" type="button"
                            data-toggle="dropdown"><span style="margin-left: -45px;">Вчителі&nbsp;</span>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="min-width: 100%;">
                        <form>
                            <script></script>
                            <div class="form-group">
                                <p><span><span onclick="OpenModalAddUser();" style="color: #2e6da4; font-size:16px;"
                                               class="cursor_pointer">&nbsp;<svg width="1em" height="1em"
                                                                                 viewBox="0 0 16 16"
                                                                                 class="bi bi-person-plus"
                                                                                 fill="currentColor"
                                                                                 xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd"
        d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg>&nbsp;Додати вчителя до системи</span></p>
                                <p><span onclick="openModalUserAdmin();" style="color: #2e6da4; font-size:16px;"
                                         class="cursor_pointer">&nbsp;<svg
                                                style="margin-top: -7px; " width="1em" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-people" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd"
        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                            </svg>&nbsp;Всі вчителі</span></p>
                            </div>
                        </form>
                    </ul>
                </div>
            <?php } ?>
            <?php if ($model["tipe"] == 2 or $model["tipe"] == 4) { ?>
                <button type="button" onclick="openJurnalZavuch();" style="width:100%; border: 1px solid #c0c0c0; font-size:16px;"
                        class="openbtn">
                    <span style="margin-left: -62px;">Журнал</span>
                </button>
                <script>
                    function redirectJurnal() {
                        window.location.assign("/web/myroom/jornal");
                    }</script>
            <?php } ?>
            <?php if ($model["tipe"] == 3 or $model["tipe"] == 2) { ?>
                <div class="dropdown">
                    <button class="openbtn dropdown-toggle" style="width:100%; border: 1px solid #c0c0c0; font-size:16px;" type="button"
                            data-toggle="dropdown"><span style="margin-left: -9px;">
                        <?php if ($model["tipe"] == 2) {
                            echo "Ваш";
                        } ?><?php if ($model["tipe"] == 3) {
                                echo "Твій";
                            } ?> розклад</span>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="min-width: 100%;">
                        <form>
                            <script></script>
                            <div class="form-group">
                                <label for="inputDate" ">Оберіть час:</label>
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="rasp_respond_date" class="form-control"
                                       onchange="ResponseRaspisanie();">

                                <br> <a href="#"
                                        style="text-decoration: underline; margin-top:-3px;  margin-left:10px; font-size:16px;  "
                                        onclick="openModalIntervalDateRaspisanie();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                        <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                                    </svg>&nbsp;<span style="font-size: 19px;">Інтервал дат</span></a>

                            </div>
                        </form>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="openbtn  dropdown-toggle" style="width:100%; border: 1px solid #c0c0c0; font-size:16px;" type="button"
                            data-toggle="dropdown"><span style="margin-left: -33px;">
                        <?php if ($model["tipe"] == 2) {
                            echo "Ваше";
                        } ?><?php if ($model["tipe"] == 3) {
                                echo "Твоє";
                            } ?> Д/З</span>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="min-width: 100%;">
                        <form>
                            <script></script>
                            <div class="form-group">
                                <label for="inputDate" ">Оберіть дату:</label>
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="rasp_dz_date" class="form-control" onchange="ResponseDZ();">
                                &nbsp;
                                <br> <a href="#"
                                        style="text-decoration: underline; margin-top:-3px; margin-left:10px; font-size:16px; Р"
                                        onclick="openModalIntervalDate();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                        <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                                    </svg>&nbsp;<span style="font-size: 19px;">Інтервал дат</span></a>
                            </div>
                        </form>
                    </ul>
                </div>
            <?php } ?>
            <?php if ($model["tipe"] != 3) { ?>
                <script>
                    function ResponseRaspisanie() {
                        var rasp_respond_date = document.getElementById('rasp_respond_date').value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'https://e-osvita.online/apirozklad/responseraspisanie?parametr1=' + rasp_respond_date + '&parametr2=respond');
                        xhr.onload = function () {
                            //var obj = JSON.parse(this.responseText);
                            console.log(this.responseText);
                            document.getElementById("open_respond_raspisanie").innerHTML = this.responseText;
                            openModalRaspisanie();
                        };
                        xhr.send(null);
                    }
                </script>
            <?php } ?>
            <?php if ($model["tipe"] == 3 or $model["tipe"] == 2) { ?>
                <script>
                    function ResponseRaspisanie() {
                        var rasp_respond_date = document.getElementById('rasp_respond_date').value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'https://e-osvita.online/apirozklad/responseraspisanie?parametr1=' + rasp_respond_date + '&parametr2=respond_uchenik');
                        xhr.onload = function () {
                            //var obj = JSON.parse(this.responseText);
                            console.log(this.responseText);
                            document.getElementById("open_respond_raspisanie").innerHTML = this.responseText;
                            openModalRaspisanie();
                        };
                        xhr.send(null);
                    }
                </script>
                <script>
                    function ResponseDZ() {
                        var rasp_dz_date = document.getElementById('rasp_dz_date').value;
                        var xhr = new XMLHttpRequest();
                        <?php if ($model["tipe"] == 3 ) { ?>
                        xhr.open('GET', 'https://e-osvita.online/apidz/responsedz?parametr1=' + rasp_dz_date + '&parametr2=uchenik');
                        <?php } ?>
                        <?php if ($model["tipe"] == 2 ) { ?>
                        xhr.open('GET', 'https://e-osvita.online/apidz/responsedz?parametr1=' + rasp_dz_date + '&parametr2=ticher');
                        <?php } ?>
                        xhr.onload = function () {
                            //var obj = JSON.parse(this.responseText);
                            console.log(this.responseText);
                            document.getElementById("open_dz_raspisanie").innerHTML = this.responseText;
                            openModalDZ();
                        };
                        xhr.send(null);
                    }
                </script>
            <?php } ?>
            <?php if ($model["tipe"] == 4 or $model["tipe"] == 1 or $model["tipe"] == 2) { ?>
                <div class="dropdown">
                    <button class="openbtn " style="width:100%; border: 1px solid #c0c0c0; font-size:16px;"
                            type="button"
                            data-toggle="dropdown"><span style="margin-left: 18px;">Змінити
                            розклад</span>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="min-width: 100%;">
                        <form>
                            <script></script>
                            <div class="form-group">
                                <label for="inputDate">Оберіть дату:</label>
                                <input type="date" title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                       id="rasp_redact_date" class="form-control"
                                       onchange=" RedactRaspisanie();">
                                <br><a href="#"
                                       style="text-decoration: underline; margin-top:-3px;  margin-left:10px; font-size:16px;  "
                                       onclick="openModalIntervalDateRedactRaspisanie();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                        <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                                    </svg>&nbsp;<span style="font-size: 19px;">Інтервал дат</span></a>
                            </div>
                        </form>
                    </ul>
                </div>
                <script>
                    function RedactRaspisanie() {
                        var rasp_respond_date = document.getElementById('rasp_redact_date').value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'https://e-osvita.online/apirozklad/responseraspisanie?parametr1=' + rasp_respond_date + '&parametr2=redact');
                        xhr.onload = function () {
                            //var obj = JSON.parse(this.responseText);
                            console.log(this.responseText);
                            document.getElementById("open_redact_raspisanie").innerHTML = this.responseText;
                            openModalRedactRaspisanie();
                        };
                        xhr.send(null);
                    }
                </script>
            <?php } ?>

            <?php if ($model["tipe"] == 2) { ?>
                <button class="openbtn " data-toggle="modal"
                        data-target=".create-dz" style="width:100%; border: 1px solid #c0c0c0;font-size:16px;" type="button">
                    <span style="margin-left: -37px;">Додати Д/З</span>
                    </span></button>
                <button class="openbtn " style="width:100%; border: 1px solid #c0c0c0; font-size:16px;" type="button"
                        onclick="openModalRepetitor();">
                   <span style="margin-left: -29px;">Я
                       репетитор</span>
                </button>
                <div class="dropdown">
                    <button class="openbtn " style="width:100%; border: 1px solid #c0c0c0; font-size:16px;"
                            type="button"
                            data-toggle="dropdown">
                        <span style="margin-left: -25px;">Тестування</span>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" style="min-width: 100%;">
                        <form>
                            <script></script>
                            <div class="form-group">
                                <a href="#"
                                   style="text-decoration: underline; margin-top:-3px;  margin-left:10px; font-size:16px;  "
                                   onclick="openModalIntervalDateTest();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
                                        <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                    </svg>
                                    <span style="font-size: 19px;">Створити</span></a>

                                <a href="#"
                                   style="text-decoration: underline; margin-top:-3px;  margin-left:10px; font-size:16px;  "
                                   onclick="openModalIntervalDateResultTest();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-bookmark" viewBox="0 0 16 16">
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                                    </svg>
                                    <span style="font-size: 19px;">Результати</span></a>
                            </div>
                        </form>
                    </ul>
                </div>
            <?php } ?>
            <!--//место реклама-->
            <br>
            <div class="card" style="border: 0px solid #615e5e;">
                <div class="card-body"></div>
            </div>
            <?php if ($model["tipe"] == 3) { ?>
                <div class="dropdown">
                    <span class="btn btn-dark" style="width:100%; border: 2px solid #cccccc; font-size:16px;"
                          type="button"
                          data-toggle="dropdown"><span id="count_new_test"><svg style="margin-left:-25px;"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-calendar4-range"
                                                                                viewBox="0 0 16 16">
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z"/>
  <path d="M9 7.5a.5.5 0 0 1 .5-.5H15v2H9.5a.5.5 0 0 1-.5-.5v-1zm-2 3v1a.5.5 0 0 1-.5.5H1v-2h5.5a.5.5 0 0 1 .5.5z"/>
</svg>&nbsp;&nbsp;&nbsp;Твої тести</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </span></button>
                    <ul class="dropdown-menu" style="min-width: 100%;">
                        <form>
                            <script></script>
                            <div class="form-group">
                                <a href="#"
                                   style="text-decoration: underline; margin-top:-3px;  margin-left:10px; font-size:16px;  "
                                   onclick="openModalTestsIntervalAll();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-back" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
                                    </svg>
                                    <span style="font-size: 19px;">Всі тести</span></a>
                            </div>
                        </form>
                    </ul>
                </div>
            <?php } ?>
        </div>
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
            </div>
        </div><!--/span-->
    </div><!--/row-->

    <div class="col-xs-12 col-sm-9" style="margin-top:5px;">
        <?php if ($model["instruktion_open"] == 0) { ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                <div class="site-about">
                    <div class="demo">
                        <?php if ($model["tipe"] == 4) { ?>
                            <input type="checkbox" id="hd-6" class="hide"/>
                            <label for="hd-6">Як користуватись ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/9yhq8RkYlkc"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 4) { ?>
                            <input type="checkbox" id="hd-1" class="hide"/>
                            <label for="hd-1">Як створити урок ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/JnHgANTNGIk"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 4) { ?>
                            <input type="checkbox" id="hd-2" class="hide"/>
                            <label for="hd-2">Як додати вчителя ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/bElZ0wV-QZc"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 4) { ?>
                            <input type="checkbox" id="hd-3" class="hide"/>
                            <label for="hd-3">Як змінити розклад ?</label>
                            <div>
                                HTML — стандартный язык разметки документов во Всемирной паутине. Большинство
                                веб-страниц содержат описание разметки на языке HTML (или XHTML). Язык HTML
                                интерпретируется браузерами и отображается в виде документа в удобной для человека
                                форме..
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 2) { ?>
                            <input type="checkbox" id="hd-6" class="hide"/>
                            <label for="hd-6">Як користуватись ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/9yhq8RkYlkc"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 2) { ?>
                            <input type="checkbox" id="hd-4" class="hide"/>
                            <label for="hd-4">Як створити розклад ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/6w_3VHn2XXE"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 2) { ?>
                            <input type="checkbox" id="hd-5" class="hide"/>
                            <label for="hd-5">Як створити тест ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/Wd2dP4f0I-s"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                            <input type="checkbox" id="hd-25" class="hide"/>
                            <label for="hd-25">Як додати Д/З ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/vyDPktMvIY0"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 3) { ?>
                            <input type="checkbox" id="hd-6" class="hide"/>
                            <label for="hd-6">Як користуватись ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/9yhq8RkYlkc"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 3) { ?>
                            <input type="checkbox" id="hd-7" class="hide"/>
                            <label for="hd-7">Як дивитись розклад ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/yYtKyFf6zEM"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 3) { ?>
                            <input type="checkbox" id="hd-8" class="hide"/>
                            <label for="hd-8">Як дивитись Д/З ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/MN5ww_w8IMM"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        <?php if ($model["tipe"] == 3) { ?>
                            <input type="checkbox" id="hd-9" class="hide"/>
                            <label for="hd-9">Як дивитись тести ?</label>
                            <div>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/bnqyyv8LoTc"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <br/>
                        <?php } ?>
                        &nbsp;
                        &nbsp;
                        <script> function Instruktionclose() {
                                var xhr = new XMLHttpRequest();
                                var id =  <?php  echo $id ?>;
                                xhr.open('GET', 'https://e-osvita.online/api/instruktionhelpclose?id=' + id, true);
                                xhr.onload = function () {
                                };
                                xhr.send(null);
                            }</script>
                        <br>
                        <button onclick="Instruktionclose();" type="submit" class="btn btn-success" data-dismiss="alert"
                                aria-label="Close"/>
                        Все зрозуміло. Закрити
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($model["tipe"] == 2) { ?>

        <?php } ?>
        <?php if ($model["tipe"] == 2) { ?>
        <?php if (empty($jornal_open)){ ?>

        <div class="modal fade bd-example-modal-sm" id="openModalSortJurnalData" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                    <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                        <p class="modal-title" id="exampleModalLongTitle">Оберіть період</p>&nbsp;
                        <div class="row">
                            <form>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <div class="input-group date">
                                            <input type="date"
                                                   title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                                   id="date20" class="form-control"/>
                                            <span class="input-group-addon">Дата</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <div class="input-group date">
                                            <input type="date"
                                                   title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                                   id="date30" onchange="goDataSearchUser();"
                                                   class="form-control"/>
                                            <span class="input-group-addon">Дата</span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <center> <button type="button" data-dismiss="modal" class="btn btn-danger" aria-label="Close">Закрити
                            </button></center>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <table>
        <tbody>
        <tr style=" font-size: 22px;  ">
            <td style="background-color: #bbb0d9; border-radius: 4px; ">&nbsp;<a href="#" onclick="SortJurnalDate();"
                                                                                 style="color: #3C3A3A;">За період</a>&nbsp;
            </td>
            <td style="background-color: #bdb0a3; border-radius: 4px; ">&nbsp;<a href="#" style="color: #3C3A3A;">По
                    класу</a>&nbsp;
            </td>
            <td style="background-color: #afcdb7; border-radius: 4px; ">&nbsp;<a href="#" style="color: #3C3A3A;">По
                    учню</a>&nbsp;
            </td>
        </tr>
        </tbody>
    </table>
    <?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[1];
    $str = $url;
    parse_str($str, $output);
    $dc = stristr($str, 'date1');
    ?>
    <script>

        function urlParam(name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results == null) {
                return null;
            }
            return decodeURI(results[1]) || 0;
        }

        function goDataSearchUser() {
            var date20 = document.getElementById('date20').value;
            var date30 = document.getElementById('date30').value;
            var d = new Date(date20);
            var dateYear20 = d.getFullYear();
            let dateMonth20 = d.getMonth() + 1;
            var chislovan20 = d.getDate();
            var b = new Date(date30);
            var dateYear30 = b.getFullYear();
            let dateMonth30 = b.getMonth() + 1;
            var chislovan30 = b.getDate();
            var link = document.location.href;
            var urls = new URL(link);
            var url = window.location.search;
            <?php if(empty($dc)){?>
            url = url.replace("?", 'date1=' + dateYear20 + '-' + dateMonth20 + '-' + chislovan20 + '&date2=' + dateYear30 + '-' + dateMonth30 + '-' + chislovan30 + '&');
            window.location.replace(window.location.pathname + "?" + url);
            <?php  } ?>

            <?php if(!empty($dc)){?>
            urls.searchParams.delete('date1');
            urls.searchParams.delete('date2');
            window.location.replace('?date1=' + dateYear20 + '-' + dateMonth20 + '-' + chislovan20 + '' +
                '&date2=' + dateYear30 + '-' + dateMonth30 + '-' + chislovan30 + '' +
                '&numberclass=' + urlParam('numberclass') + '' +
                '&literaclass=' + urlParam('literaclass') + '' +
                '&school=' + urlParam('school'));
            //window.location.href("?", 'date2=' + dateYear20 + '-' + urls);
            <?php  } ?>
        }

        function SortJurnalDate() {
            $("#openModalSortJurnalData").modal('show');
        }</script>
    <center>
        <div class="modal fade" id="openModalJornalDetails" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div style="width: 50%;" role="document">
                <div class="modal-content" style="background-color: #007fff;">
                    &nbsp;<button type="button" class="close" onclick="openModalJornalDetailsClose();"
                                  data-dismiss="modal">X</button>
                    <h5 class="modal-title" id="exampleModalLongTitle">&nbsp;&nbsp;&nbsp;<span
                                style="color: #ffffff; font-size: 20px; ">Редагування запису</span></h5>

                    <div class="rasp" style="background-color: #ffffff; overflow-x: hidden;">

                        <div class="modal-body" id="responseOpenModalJornalDetails"></div>
                    </div>
                    <div class="modal-footer" style="background-color: #ffffff;">
                        <center>
                            <button type="button" class="btn btn-danger" onclick="openModalJornalDetailsClose();"
                                    data-dismiss="modal">Закрити
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <center>
        <div class="modal fade" id="openModalJornalUchenic" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div style="width: 90%;" role="document">
                <div class="modal-content" style="background-color: #ffffff;">

                    <div class="rasp" style="background-color: #ffffff;  overflow-x: hidden;">
                        <button type="button" class="close" onclick="openModalJornalClose();"
                                data-dismiss="modal">X</button>
                        <table id="respond200" class="table table_sort">
                        </table>
                    </div>
                    <div class="modal-footer">
                        <center>
                            <button type="button" class="btn btn-danger" onclick="openModalJornalClose();"
                                    data-dismiss="modal">Закрити
                            </button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <div class="rasp" style="background-color: #ffffff; height:420px; overflow-x: hidden;">
        <table class="table table_sort" style="border-radius: 4px; margin-top: 4px;">
            <thead>
            <tr>
                <td colspan="4" style="background-color: #c4e2ff; ">Журнал</td>
            </tr>
            <tr>
                <th scope="col">Предмет&nbsp;▼</th>
                <th scope="col">Дата&nbsp;▼</th>
                <th scope="col">Клас&nbsp;▼</th>
                <th scope="col">Дія&nbsp;▼</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($jornal_data_respond as $jornal_value_respond) {
                echo '<tr>
                        <td>' . $jornal_value_respond["name_predmet"] . '</td>
                         <td>' . $jornal_value_respond["datetimeurok"] . '</td>
                        <td>' . $jornal_value_respond["classnumber_id"] . '-' . $jornal_value_respond["classlater_id"] . '</td>
                        <td><a style="cursor: pointer; text-decoration: underline;" onclick="openModalUserUchenic(' . $jornal_value_respond["id"] . ');">Відкрити</a></td>
                    </tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    <script>function openModalUserUchenic(id) {
            $("#openModalJornalUchenic").modal('show');
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://e-osvita.online/apijornal/openticherjornaldetail?id=' + id, true);
            xhr.onload = function () {
                document.getElementById("respond200").innerHTML = this.responseText;
            };
            xhr.send(null);
        }</script>
    <script>function openModalJornalClose() {
            $("#openModalJornalUchenic").modal('hide');
        }</script>
    <script>function openModalJornalDetails() {
            $("#openModalJornalUchenic").modal('hide');
            $("#openModalJornalDetails").modal('show');
        }</script>
    <script>function openModalJornalDetailsClose() {

            $("#openModalJornalDetails").modal('hide');
            $("#openModalJornalUchenic").modal('show');
        }</script>
    <script>document.addEventListener('DOMContentLoaded', () => {
            const getSort = ({target}) => {
                const order = (target.dataset.order = -(target.dataset.order || -1));
                const index = [...target.parentNode.cells].indexOf(target);
                const collator = new Intl.Collator(['en', 'ru'], {numeric: true});
                const comparator = (index, order) => (a, b) => order * collator.compare(
                    a.children[index].innerHTML,
                    b.children[index].innerHTML
                );
                for (const tBody of target.closest('table').tBodies)
                    tBody.append(...[...tBody.rows].sort(comparator(index, order)));

                for (const cell of target.parentNode.cells)
                    cell.classList.toggle('sorted', cell === target);
            };
            document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
        });</script>
    <?php } ?>
    <?php if (!empty($jornal_open)) { ?>
        <div class="modal fade bd-example-modal-sm" id="openModalSortJurnalDataD" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                    <div class="modal-header" style="border-bottom: 0px solid #e5e5e5;">
                        <p class="modal-title" id="exampleModalLongTitle">Оберіть дату, або період</p>&nbsp;
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker10">
                                        <input type="date"
                                               title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                               id="date50" class="form-control"/>
                                        <span class="input-group-addon">Дата</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <input type="date"
                                               title="Щоб обрати дату, натисніть иконку календаря в цьому полі"
                                               id="date40" onchange="goDataSearchUserD();"
                                               class="form-control"/>
                                        <span class="input-group-addon">Дата</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-dismiss="modal" class="btn btn-danger" aria-label="Close">Закрити
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <table>
            <tbody>
            <tr style=" font-size: 22px;  ">
                <td style="background-color: #bbb0d9; border-radius: 4px; ">&nbsp;<a href="#"
                                                                                     onclick="javascript:history.back();"
                                                                                     style="color: #3C3A3A;">За
                        період</a>&nbsp;
                </td>
            </tr>
            </tbody>
        </table>

        <div class="rasp" style="background-color: #ffffff; height:420px; overflow-x: hidden;">
            <table class="table table_sort">
                <thead>
                <tr>
                    <td colspan="8" style="background-color: #c4e2ff; "> <?php
                        foreach ($usera_details as $value_class) {
                        };
                        echo "<h3>" . $value_class["classnumber"] . "-" . $value_class["classlater"]; ?></h3></td>
                </tr>
                <tr>
                    <th scope="col">ID&nbsp;▼</th>
                    <th scope="col">Учень&nbsp;▼</th>
                    <th scope="col">Статус&nbsp;▼</th>
                    <th scope="col">Редагувати&nbsp;▼</th>
                    <th scope="col">Зауваження&nbsp;▼</th>
                    <th scope="col">Батькам&nbsp;▼</th>
                    <th scope="col">Оцінки&nbsp;▼</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($usera_details as $value_usera_details) {
                    echo '<tr>
      <td scope="row">' . $value_usera_details["id"] . '</td>
       <td scope="row">' . $value_usera_details["firstname"] . ' ' . $value_usera_details["lastname"] . '</td>
        <td scope="row">1</td>
         <td scope="row"><a  href="" style=" text-decoration: underline; color:#4169E1;"  href="">Редагувати</a></td>
          <td scope="row"><a  href="" style=" text-decoration: underline; color:#4169E1;" href="">Зробити</a></td>
                     <td scope="row"><a  href="" style=" text-decoration: underline; color:#4169E1;" href="">Написати</a></td>
          <td scope="row"><a href="" style=" text-decoration: underline; color:#4169E1;" onclick="openJornal();">Відкрити</a></td>
                    </tr>';
                }
                ?>
                <script>document.addEventListener('DOMContentLoaded', () => {
                        const getSort = ({target}) => {
                            const order = (target.dataset.order = -(target.dataset.order || -1));
                            const index = [...target.parentNode.cells].indexOf(target);
                            const collator = new Intl.Collator(['en', 'ru'], {numeric: true});
                            const comparator = (index, order) => (a, b) => order * collator.compare(
                                a.children[index].innerHTML,
                                b.children[index].innerHTML
                            );
                            for (const tBody of target.closest('table').tBodies)
                                tBody.append(...[...tBody.rows].sort(comparator(index, order)));
                            for (const cell of target.parentNode.cells)
                                cell.classList.toggle('sorted', cell === target);
                        };
                        document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
                    });</script>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <?php } ?>
    <?php if ($model["tipe"] == 3) { ?>

        <table class="table table-bordered" style="border-radius: 4px; margin-top: 4px;">
            <thead>
            <tr>
                <td colspan="5" style="background-color: #c4e2ff; ">Твої оцінки</td>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата&nbsp;▼</th>
                <th scope="col">Предмет&nbsp;▼</th>
                <th scope="col">Оцінка&nbsp;▼</th>
                <th scope="col">Середній бал&nbsp;▼</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <th scope="row">1</th>
                <td><?php echo $today = date("d.m.Y"); ?></td>
                <td>Хімія</td>
                <td>11</td>
                <td>9</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td><?php echo $today = date("d.m.Y"); ?></td>
                <td>Хімія</td>
                <td>11</td>
                <td>9</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td><?php echo $today = date("d.m.Y"); ?></td>
                <td>Хімія</td>
                <td>11</td>
                <td>9</td>
            </tr>

            </tbody>
        </table>
    <?php } ?>
    <?php if ($model["tipe"] == 4) { ?>
        <table class="table table-bordered" style="border-radius: 4px; margin-top: 4px;">
            <thead>
            <tr>
                <td colspan="7" style="background-color: #c4e2ff; ">Розклад на
                    :<?php echo $today = date("d.m.Y"); ?></td>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата&nbsp;▼</th>
                <th scope="col">Клас&nbsp;▼</th>
                <th scope="col">Предмет&nbsp;▼</th>
                <th scope="col">Вчитель&nbsp;▼</th>
                <th scope="col">Час&nbsp;▼</th>
                <th scope="col">Дія&nbsp;▼</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td><?php echo $today = date("d.m.Y"); ?></td>
                <td>Хімія</td>
                <td>5-Б</td>
                <td>Василь П.П.</td>
                <td>9:00</td>
                <td>Редагувати</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td><?php echo $today = date("d.m.Y"); ?></td>
                <td>Хімія</td>
                <td>5-Б</td>
                <td>Василь П.П.</td>
                <td>9:00</td>
                <td>Редагувати</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td><?php echo $today = date("d.m.Y"); ?></td>
                <td>Хімія</td>
                <td>5-Б</td>
                <td>Василь П.П.</td>
                <td>9:00</td>
                <td>Редагувати</td>
            </tr>
            </tbody>
        </table>
    <?php } ?>
    <?php if ($model["tipe"] == 4) { ?>
        <table class="table table-bordered" style="border-radius: 4px; margin-top: 4px;">
            <thead>
            <tr>
                <td colspan="3" style="background-color: #c4e2ff; ">Список вчителів :</td>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Вчитель&nbsp;▼</th>
                <th scope="col">Дія&nbsp;▼</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <th scope="row">1</th>
                <td>Василь П.П.</td>
                <td>Редагувати</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Василь П.П.</td>
                <td>Редагувати</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Василь П.П.</td>
                <td>Редагувати</td>
            </tr>

            </tbody>
        </table>
    <?php } ?>
    <div class="jumbotron">
        <script src="./оjs_files/calendar_kdg_utf8.min.js"></script>
        <div class="modal fade" id="modalTest" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="modalTestsStart">
                    </div>
                    <div class="modal-footer">
                        <center>
                            <input id="datapole1"
                                   onclick="event.cancelBubble=true;this.select();_Calendar.lcs(this)"
                                   onfocus="this.select();_Calendar.lcs(this)" type="text" value="yy-mm-dd"
                                   data-yearto="5" data-yearfrom="-80">

                            <input id="datapoless2"
                                   onclick="event.cancelBubble=true;this.select();_Calendar.lcs(this)"
                                   onfocus="this.select();_Calendar.lcs(this)" type="text" value="yy-mm-dd"
                                   data-yearto="5" data-yearfrom="-80">
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function Modaldatapole() {
                var datapole1 = document.getElementById('datapole1').value;
                var datapoles2 = document.getElementById('datapoless2').value;

                var a = new Date(datapole1);
                var b = new Date(datapoles2);

                var res = [
                    addLeadZero(b.getDate()),
                    addLeadZero(b.getMonth() + 1),
                    b.getFullYear()
                ].join('-');

                var restu = [
                    addLeadZero(a.getDate()),
                    addLeadZero(a.getMonth() + 1),
                    a.getFullYear()
                ].join('-');

                alert(res);
                alert(restu);
            }

            function Modaltest() {

                $("#modalTest").modal('show');
            }
        </script>
    </div><!--/span-->
</div><!--/span-->
</div>

<script>
    function RespondPredmet(param1) {
        var xhr = new XMLHttpRequest();
        var number_class = param1;
        xhr.open('GET', 'https://e-osvita.online/api/predmeti?param=' + number_class, true);
        xhr.onload = function () {
            // openModalRaspisanieCreate();
            // closeModalRaspisanieCreate();
            document.getElementById("number-list-response-predmet").innerHTML = this.responseText;
            TicherAddResponseSelect();
        };
        xhr.send(null);
    }

    function RaspisanieRedact(id_urok) {
        var xhr = new XMLHttpRequest();
        var var_id_urok = id_urok;
        xhr.open('GET', 'https://e-osvita.online/apirozklad/raspisanieredact?parametr1=' + var_id_urok + '&parametr2=delete', true);
        xhr.onload = function () {
            alert("Видалити запис ?");
            alert("Видалено ...");
        };
        xhr.send(null);
    }

    function DeleteUsers(id_users) {
        var xhr = new XMLHttpRequest();
        var var_id_users = id_users;
        xhr.open('GET', 'https://e-osvita.online/api/usersredact?parametr1=' + var_id_users + '&parametr2=delete', true);
        xhr.onload = function () {
            alert("Видалити запис ?");
            alert("Видалено ...");

        };
        xhr.send(null);
    }

    function DisplayVisibleBlock(parametr1, parametr2) {
        var xhr = new XMLHttpRequest();
        var date_urok = parametr1;
        var active_urok = parametr2;
        xhr.open('GET', 'https://e-osvita.online/apirozklad/visibleraspisanie?parametr1=' + date_urok + '&parametr3=' + active_urok, true);
        xhr.onload = function () {
            $("#openRedactRaspisanie").modal('toggle');
            $("#openModalIntervalDateRaspisanieResponseAdmin").modal('show');
            document.getElementById("modalIntervalDateRaspisanieAdmin").innerHTML = this.responseText;
        }
        xhr.send(null);
    }

    function TicherAddResponseSelect() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/ticheraddresponseselect', true);
        xhr.onload = function () {
            document.getElementById("ticher-add").innerHTML = this.responseText;
        }
        xhr.send(null);
    }

    function OpenModalAddUser() {
        $("#openModalAddUser").modal('show');
    }

    function CreateUser() {
        var xhr = new XMLHttpRequest();
        var firstname = document.getElementById('add_user_firstname').value;
        var lastname = document.getElementById('add_user_lastname').value;
        var otchestvo = document.getElementById('add_user_otchestvo').value;
        var email = document.getElementById('add_user_email').value;
        var predmet0 = document.getElementById('dataticheradd0').value;
        xhr.open('GET', 'https://e-osvita.online/api/createuseradd?parametr1=' + firstname + '&parametr2=' + lastname + '&parametr3=' + otchestvo + '&parametr4=' + email + '&predmet0=' + predmet0, true);
        xhr.onload = function () {
            var obj = JSON.parse(this.responseText);
            if (obj.respond == 1) {
                $("#messageModalUsersCreate").modal('show');

                document.getElementById('add_user_firstname').value = "";
                document.getElementById('add_user_lastname').value = "";
                document.getElementById('add_user_otchestvo').value = "";
                document.getElementById('add_user_email').value = "";
            }
            if (obj.respond == 0) {
                alert("Помилка! Користувача с таким e-mail вже зареєстровано");
            }
        }
        xhr.send(null);
    }

    function addLeadZero(val) {
        if (+val < 10) return '0' + val;
        return val;
    };

    function hashtrue() {
        var xhr = new XMLHttpRequest();
        var id = <?php  echo $model["id"]?>;
        xhr.open('GET', 'https://e-osvita.online/apirozklad/userhashreturn?id=' + id, true);
        xhr.onload = function () {
            document.getElementById("hash").innerHTML = this.responseText;
        }
        xhr.send(null);

    };
    setInterval(hashtrue, 1000);

    function hashtruedz() {
        var xhr = new XMLHttpRequest();
        var id = <?php  echo $model["id"]?>;
        xhr.open('GET', 'https://e-osvita.online/apidz/userhashreturndz?id=' + id, true);
        xhr.onload = function () {
            document.getElementById("hashdz").innerHTML = this.responseText;
        }
        xhr.send(null);
    };
    setInterval(hashtruedz, 1000);
</script>





