<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Instruction';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Modal -->
<!--////////////////////////////Окно открітия прохождения теста----->
<!-- Modal -->
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
        background-color: #2e6da4;
        color: white;
        padding: 10px 15px;

        border-radius: 5px;

    }

    .openbtn:hover {
        background-color: #ffff00;
    }


    /* На небольших экранах, где высота меньше 450px, измените стиль sidenav (меньше отступов и меньший размер шрифта) */
    @media screen and (max-height: 450px) {
        .sidebar {padding-top: 15px;}
        .sidebar a {font-size: 18px;}
    }
    #main {
        margin: 0px;
        background: e6eeee;
        z-index: 2;
        position: fixed;
        top: 0px;
        left: 0px;
        margin-top:51px;
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
        <input type="hidden" name="_csrf" value="QaN_NFqPAn_ylL9laHBY5MhaOr7lRWTyEOL_nqZ6vZko0TBxYupOGsLb9ylRKGud-hRX25UyEqslqav91y3y8g=="><button type="submit" class="btn btn-danger" ><svg  width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-door-open" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM11.5 2H11V1h.5A1.5 1.5 0 0 1 13 2.5V15h-1V2.5a.5.5 0 0 0-.5-.5z"/>
                <path fill-rule="evenodd" d="M10.828.122A.5.5 0 0 1 11 .5V15h-1V1.077l-6 .857V15H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117z"/>
                <path d="M8 9c0 .552.224 1 .5 1s.5-.448.5-1-.224-1-.5-1-.5.448-.5 1z"/>
               </svg>(ВИХІД)</button></form></span>
    <a href="">
        <input type="hidden" name="_csrf" value="TH57CrLPkvrYf-0VRtG4fbylOioJDEfcG8E1P7kku4QuN0hS4Zj1rZkGuEUog80v-p1dRDtLcKspr1sH-AmO5g=="><button type="submit" style="margin-top:12px;" class="btn btn-warning">Наш магазин&nbsp;&nbsp;&nbsp;&nbsp;<svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-cart3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg></button></a>


</div>
<a href="#"  style="margin-left: -130px; position: fixed;" class="btn btn-warning" onclick="history.back();return false;">Назад</a><div id="main" style="margin-top: 75px;">
    <button class="openbtn" onclick="openNav()">
        меню
    </button>
</div>
<div class="site-about">
    <div class="demo" style="font-size: 25px;">
        <input type="checkbox" id="hd-1" class="hide"/>
        <label for="hd-1" >Як створити урок / розклад?</label>
        <div>
           Для того щоб створити урок, потрібно в МЕНЮ з правого боку натиснути кнопку ДОДАТИ РОЗКЛАД та заповнити форму, після цього натиснути кнопку СТВОРИТИ.Система автоматично створить урок з використанням конференцій ZOOM, ніяких посилань нікому передавати НЕ ПОТРІБНО,  учню залишиться тільки бути на сайті в або до потрібного часу, якщо учень ЗАПІЗНИВСЯ, система безпомилково перенаправить його на урок та підключить да конференціі.
             </div>
        <br/>
        <br/>

        <input type="checkbox" id="hd-3" class="hide"/>
        <label for="hd-3" >Як створити тест ?</label>
        <div>
            Для того щоб створити тест, потрібно в МЕНЮ з правого боку натиснути кнопку ТЕСТУВАННЯ та в натиснути посилання що відкрилося СТВОРИТИ, заповнити форму, де чекбоксами ( квадратики) відмічається вірна відповідь (одна).
                </div>
        <br/>
        <br/>
        <input type="checkbox" id="hd-4" class="hide"/>
        <label for="hd-4">Як користуватися ? - (учню покроково)</label>
        <div>

            Для того щоб почати користуватися порталом, достатньо УЧНЮ зареєструватися з вірними данними та бути на сайті в приблизний час, не обов`язково УЧНЮ бути на сайті в час розкладу, це означає якщо учень спізнився то система автоматично перенаправить його до його класу (конференціі),або учень занадто рано увійшов на сайт у такому разі система теж сповіщить та перенаправить до уроку. </div>
    </div>

</div>

