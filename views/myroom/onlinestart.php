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
        margin-top: 51px;
    }
</style>
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
        margin-top: 51px;
    }
</style>
<center>
        <p><?php
            //echo $data_zoom["zoomdata"];
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            function sofa_get_uri() {
                $host = $_SERVER['SERVER_NAME'];
                $self = $_SERVER["REQUEST_URI"];
                return $self;
            }
            ?>
            <a href="<?php
            if ($model["tipe"] == 3) {
                if(isset($_GET['cod'])){
                   $code = $_GET['cod'];
                }
                $room_data = Yii::$app->db->createCommand("SELECT * FROM {{room_name}} WHERE [[code_uroka]] = '$code' ORDER BY [[id]] DESC LIMIT 1")->queryOne();
                $raspisanie_data = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[code_uroka]] = '$code' ")->queryOne();
                $tit = $raspisanie_data["timeendurok"];
                $dat = $raspisanie_data["timeendurok"];
                $calendart = date("Y-m-d", strtotime($tit));
                $timet = date("H:i:s",  strtotime($dat));
                $room_name = $room_data["room_name"];
                if(empty($room_name)){
               
                }else {
                    echo "https://e-osvita.online:8444/client2/examples/demo/streaming/conference/conference.html?id=".$model["id"]."&roomName=" . $room_name . "&user=" . $model["username"] . "&code=".$raspisanie_data["code_uroka"]."&user_tipe=3&calendar=" . $calendart . "&time=" . $timet . "";
                }
            }
            if ($model["tipe"] == 2) {
                if(isset($_GET['cod'])){
                    $code = $_GET['cod'];
                }
                $user_id = Yii::$app->user->id;
                $data_urok = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[code_uroka]] = '$code'")
                    ->queryOne();

                $search_code = Yii::$app->db->createCommand("SELECT [[code_uroka]] FROM {{status_user_reload}} WHERE [[code_uroka]] = '$code'")
                    ->queryOne();
                if (!empty($search_code)) {
                    Yii::$app->db->createCommand("UPDATE {{status_user_reload}} SET [[active]] = 2 WHERE  [[code_uroka]] = '$code'")->execute();
                }
                $raspisanie_data = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[ticher_id]] = '$user_id' ")->queryOne();
                $ti = $raspisanie_data["timeendurok"];
                $da = $raspisanie_data["timeendurok"];
                $calendar = date("Y-m-d", strtotime($ti));
                $time = date("H:i:s",  strtotime($da));
                echo "https://e-osvita.online:8444/client2/examples/demo/streaming/conference/conference.html?id=".$model["id"]."&user=".$model["username"]."&calendar=". $calendar."&time=". $time."&user_tipe=2&code=".$raspisanie_data["code_uroka"]."&school=".$data_urok["school_id"]."&classnumber=".$data_urok["classnumber_id"]."&classlater=".$data_urok["classlater_id"]."&namepredmet=".$data_urok["name_predmet"]."";
            }
            ?>"  target="_self">
                <?php if ($model["tipe"] == 2) {     ?>
    <div class="alert alert-success" role="alert">
                    <span class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16"
                                                       class="bi bi-camera-reels" fill="currentColor"
                                                       xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M0 8a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8zm11.5 5.175l3.5 1.556V7.269l-3.5 1.556v4.35zM2 7a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2z"/>
            <path fill-rule="evenodd" d="M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M9 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>Перейти до класу </span>
    </div>
                <?php } ?>
            <?php if ($model["tipe"] == 3 and !empty($room_name)) {     ?>
    <div class="alert alert-success" role="alert">
                <span class="btn btn-success"><svg width="1em" height="1em" viewBox="0 0 16 16"
                                                                   class="bi bi-camera-reels" fill="currentColor"
                                                                   xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M0 8a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8zm11.5 5.175l3.5 1.556V7.269l-3.5 1.556v4.35zM2 7a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2z"/>
            <path fill-rule="evenodd" d="M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M9 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>Перейти до класу </span>
    </div>
        <?php } ?>
                <?php if ($model["tipe"] == 3 and empty($room_name)) {     ?>
    <div class="alert alert-warning" role="alert">
        <p><span >Вчитель ще не розпочав трансляцію ... Очікуємо :)</span></p>
        <p><span >Після початку трансляціі автоматичне перенаправлення.</span></p>
    </div>
                <?php } ?>
            </a>
        </p>
        <hr>

    <p class="mb-0">"Ибо так возлюбил Бог мир, что отдал Сына Своего Единородного, дабы всякий, верующий в Него, не погиб, но имел жизнь вечную."</p>
    <p class="mb-0">Иоана гл.3 ст.16</p>
</center>

<!--////////////////////////////Окно оповещения о скором уроке----->
<div class="modal fade" id="ModalTicherNo" tabindex="-1" data-toggle="modal" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="alert alert-info" role="alert">
            Чекаємо вчителя ...
        </div>
    </div>
</div>
<?php
$school = $model['school'];
?>
<?php if ($model["tipe"] == 3) { ?>
    <script>
        function explode() {
            <?php
            $urls = $_SERVER['REQUEST_URI'];
            $wwws = strstr($urls, "cod=");
            $strs = $wwws;
            $results = substr(strstr($strs, '='), 1, strlen($strs));
            $string_browse = $_SERVER['QUERY_STRING'];
            ?>
            var xhr = new XMLHttpRequest();
            var code = <?php  echo $results ?>;
            xhr.open('GET', 'https://e-osvita.online/api/onlineticherno?cod=' + code, true);
            xhr.onload = function () {
                if (this.responseText == 0) {
                    window.location.replace("https://e-osvita.online/web/myroom/online?<?php echo $string_browse ?>");
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
        document.getElementById("main").style.marginLeft = "0";
    }

    function redirectCabinetIfNetUrokaOnline() {



        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://e-osvita.online/api/redirectifyesurok?code='+code, true);
        xhr.onload = function () {
            var obj = JSON.parse(this.responseText);
            console.log(this.responseText);

        };
        xhr.send(null);
    }

    setInterval(redirectCabinetIfNetUrokaOnline, 1000);

    function redirectUrokifyesroomname() {
        <?php
        $url = $_SERVER['REQUEST_URI'];
        $www = strstr($url, "cod=");
        $str = $www;
        $result = substr(strstr($str, '='), 1, strlen($str));
        $result; ?>


        var xhr = new XMLHttpRequest();
        var code = <?php echo $result ?>;
        xhr.open('GET', 'https://e-osvita.online/api/redirectifyesurok?code=' +code, true);
        xhr.onload = function () {
            if(this.responseText == 1){
                
                $(document).ready(function(){
                    //Check if the current URL contains '#'
                    if(document.URL.indexOf("#")==-1){
                        // Set the URL to whatever it was plus "#".
                        url = document.URL+"#";
                        location = "#";

                        //Reload the page
                        location.reload(true);
                    }
                });
            }




        };
        xhr.send(null);
    }

    setInterval(redirectUrokifyesroomname, 1000);

</script>
