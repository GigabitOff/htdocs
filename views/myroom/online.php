<?php

/* @var $this yii\web\View */

$this->title = 'on-Line';
$this->params['breadcrumbs'][] = $this->title;
?>
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
    }

    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidebar a:hover {
        color: #f1f1f1;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 2;
        right: 25px;
        font-size: 46px;
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

    <h2 >Очікуйте, створюю клас...</h2>
<p><img src="/web/820708963.gif" alt="Пример" width="150" height="190"></p>
<!--////////////////////////////Окно оповещения о скором уроке----->

        <div class="modal fade" id="ModalTicherNo" tabindex="-1" data-toggle="modal" data-backdrop="static"
             data-keyboard="false">
            <div class="modal-dialog" role="document">

        <div class="alert alert-info" role="alert">
            Чекаємо вчителя ...
        </div>

    </div>
</div>
<!--////////////////////////////Окно оповещения о скором уроке----->

<div class="modal fade" id="ModalTicherYes" tabindex="-1" data-toggle="modal" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog" role="document">

        <div class="alert alert-success" role="alert">
            Вчитель вже очікуе. Розпочати ...
        </div>
    </div>
</div>

<?php
$user_id = Yii::$app->user->id;
$model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
$school = $model['school'];
?>
<?php if ($model["tipe"] == 3 or $model["tipe"] == 2) { ?>
<script>
    function explode() {

        <?php
        $urls = $_SERVER['REQUEST_URI'];

        $wwws = strstr($urls,"cod=");
        $strs =$wwws;
        $results = substr(strstr($strs, '='), 1, strlen($strs));

       $string_browse =  $_SERVER['QUERY_STRING'];
         ?>

            var xhr = new XMLHttpRequest();

            var code = <?php  echo $results ?>;

            xhr.open('GET', 'https://e-osvita.online/api/onlineticherno?cod=' + code, true);
            xhr.onload = function () {
                if(this.responseText == 0){
                    $("#ModalTicherNo").modal('show');
                    //window.location.replace("http://stackoverflow");

                }
                if(this.responseText == 1){

                    $("#ModalTicherNo").modal('hide');
                    window.location.replace("https://e-osvita.online/myroom/onlinestart?<?php echo $string_browse ?>#");
                }
                 }
            xhr.send(null);
        }


     setInterval(explode, 3000); //10000 это время, через которое нужно запустить функцию (1 секунд = 1000 миллисекунд)
</script>
<?php } ?>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("main").style.marginLeft = "0";

    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
    }

    function redirectCabinetIfNetUrokaOnline() {

      <?php
        $url = $_SERVER['REQUEST_URI'];
        $www = strstr($url,"cod=");
        $str =$www;
        $result = substr(strstr($str, '='), 1, strlen($str));
         $result; ?>

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/redirectifnourok?ids=<?php echo $result ?>', true);
        xhr.onload = function () {
            var obj = JSON.parse(this.responseText);
            console.log(this.responseText);
            if(this.responseText == 3){
                window.location.href = "https://e-osvita.online/myroom";

            }

        };
        xhr.send(null);
    }
    setInterval(redirectCabinetIfNetUrokaOnline, 1000);
</script>
