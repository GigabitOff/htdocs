<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="site-index" style="margin-top:80px;">
    <div class="jumbotron" style="color: #ffffff; ">
        <h2><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-diamond" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                <path fill-rule="evenodd" d="M8.361 1.17a.51.51 0 0 0-.722 0L4.766 4.044 8 7.278l3.234-3.234L8.361 1.17zm3.595 3.596L8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873zm-.722 7.19L8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873zm-7.19-.722L7.278 8 4.044 4.766 1.17 7.639a.511.511 0 0 0 0 .722l2.874 2.873zM6.917.45a1.531 1.531 0 0 1 2.166 0l6.469 6.468a1.532 1.532 0 0 1 0 2.166l-6.47 6.469a1.532 1.532 0 0 1-2.165 0L.45 9.082a1.531 1.531 0 0 1 0-2.165L6.917.45z"/>
            </svg>&nbsp;e-Osvita, сучасна освіта !</h2>
        <tr>
            <?php
            if( strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false ||
                strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false){
                echo '<p>Нажаль наш сайт не працює з браузером Internet Explorer :(</p><p>Але мы ВІДМІННО працюємо з будьяким іншим, наприклад:</p></p><p>Google Hrome, Opera, Firefox, Safari або Edge</p>';
            }else{
                echo'<td><a class="btn btn-lg btn-success" href="/site/login">&nbsp;&nbsp;Розпочати&nbsp;&nbsp;&nbsp;</a></td><td><a href="/site/login?demo=1"><button type="button"  class="btn btn-warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEMO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a></td>';
            }
            ?>
        </tr>
    </div>
    <center><span style="font-size:24px; color:#337ab7;">
            <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita інноваційна система, яка спроможна організувати весь процес дистанційної освіти, спроможна повністю відтворити процесс навчання у школі.</p>
    <p style="background-color: #ffffff; border-radius: 5px;"  >e-Osvita допомагає організувати та проконтролювати розклад уроків та їх проведення.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita простежить та унеможливить плутанини для учня та вчителя при онлайн відео - конференціях .</p>
     <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita це відсутність будьяких лімітів на виде-конференціі, повна БЕЗКОШТОВНІСТЬ !!! .</p>
            <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita створить автоматично конференцію та відкриє її у потрібний час, в потрібному класі, а також унеможливить втручання в навчальний процес інших осіб.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita проінформує учня та вчителя о розкладі та вчасно почне і закінчить конференцію та урок.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita проінформує, що був доданий новий урок з розкладом, та не дасть запізнитись учню та вчителю, і з 100% точністю відкриє клас-конференцію для учня та вчителя.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita проконтролює створення вчителем домашнього завдання та точно відкриє його для потрібного класу або учня.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita надає можливість створювати розклад та редагувати його, також є можливість додавати вчителів.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita має інструменти для створення тестів та їх оцінювання.</p>
    <p style="background-color: #ffffff; border-radius: 5px;" >e-Osvita спроможна ЗНАЧНО ПОЛЕГШИТИ та автоматизувати весь процес дистанційної та очної освіти за допомогою ОНЛАЙН ЖУРНАЛУ !</p>
        </span></center>
</div>
