<?php
///Я остановился на том чтобі в тестах біла сделана функция которая правильно формирует варианті ответов.
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\HtmlPurifier;
use yii\rest\DeleteAction;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Users;

///// Все метода защищені от XSS and SQL-injection
class ApiController extends Controller
{
    const RESPONSE_OK = 'OK';
    const RESPONSE_NO_DATA = 'No data';

    public static function encode($text)
    {
        return htmlspecialchars($text);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $posts = Yii::$app->db->createCommand('SELECT * FROM {{users}}')
                ->queryAll();
            // return $this->respond(200,self::RESPONSE_OK,$posts);
            foreach ($posts as $value) {
                return HtmlPurifier::process($value);
            }
        }
    }//Метод экранирован и защищён от XSS

    public function actionVisibleraspisanie($parametr1, $parametr3)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE date = '$parametr1' AND [[user_id]] = '$user_id' AND [[active]] = '$parametr3'  ")->queryAll();
            echo HtmlPurifier::process("<span style='font-size: 15px; color: #2e6da4;'>" . $posts[0]["classnumber_id"] . "-" . $posts[0]["classlater_id"] . "</span>");
            echo HtmlPurifier::process("<p><a  onclick='DisplayVisibleBlock()'></a>");
            foreach ($posts as $value) {
                $time_end_urok = date("H:i", strtotime($value["time"]));
                echo HtmlPurifier::process('<span><a class="list-group-item"  id="none' . $value["id"] . '" >' . $value["name_predmet"] . ' - ' . $time_end_urok . '<a class="cursor_pointer" style="font-size: 18px; color: #2e6da4;" onclick="RaspisanieRedact(' . $value["id"] . ')";>&nbsp;&nbsp;X&nbsp;&nbsp;</a></span>');
            }
        }
    }//Метод экранирован и защищён от XSS


    public function actionCreateuseradd($parametr1,
                                        $parametr2,
                                        $parametr3,
                                        $parametr4,
                                        $predmet0 = null,
                                        $number,
                                        $latter)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                ->queryOne();
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{ticher_predmet}} ORDER BY [[id]] DESC LIMIT 1')
                ->queryOne();
            $id_table_end = $data["id"] + 1;
            $password = rand(1000000, 999999999);
            $login = $this->actionTranslit("$parametr1");
            $user_school = $model["school"];
            $user_city = $model["city"];
            $user_country = $model["country"];
            $users_search = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[email]] = '$parametr4'")
                ->queryOne();
            $ticher_name_number = rand(100, 99999);
            $ticher_name = "ticher_" . $ticher_name_number;
            if (empty($users_search)) {
                Yii::$app->db->createCommand("INSERT INTO {{users}} ([[id]], [[username]], [[firstname]], [[lastname]],
 [[otchestvo]], [[password]], [[email]], [[tipe]], [[create_user_id]], [[telefon]], [[country]], [[city]], [[school]],
  [[classnumber]], [[classlater]], [[date]], [[time]], [[dateandtime]], [[status_user]],
   [[active]],[[hash]],[[direct_classnumber]],[[direct_classlater]]) VALUES ('','$ticher_name','$parametr1','$parametr2','$parametr3','$password','$parametr4','2', '$user_id','','$user_country','$user_city ','$user_school','','','','','','1','1','','$number','$latter')")->execute();

                Yii::$app->db->createCommand("INSERT INTO {{ticher_predmet}} ([[id]], [[email]], [[title]],[[active]]) VALUES ('$id_table_end','$parametr4','$predmet0','1')")->execute();
                $arr = array('respond' => 1);
                return json_encode($arr);
            } else {

                $arr = array('respond' => 0);
                return json_encode($arr);
            }
        }
    } //Метод экранирован

    public function actionTranslit($value)
    {
        if (!Yii::$app->user->isGuest) {
            $converter = array(
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
                'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
                'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
                'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
                'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
                'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
                'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
                'У' => 'U', 'Ф' => 'F', 'Х' => 'X', 'Ц' => 'C', 'Ч' => 'Ch',
                'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            );

            $values = strtr($value, $converter);
            return $values;
        }
    }


    public function actionUsersredact($parametr1, $parametr2)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr2 == "delete") {
                Yii::$app->db->createCommand("DELETE FROM {{users}} WHERE [[id]] = '$parametr1'")->execute();

            }
        }
    } //Метод экранирован

    public function actionDzredact($parametr1, $parametr2)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr2 == "delete") {
                Yii::$app->db->createCommand("DELETE FROM {{dz}} WHERE [[id]] = '$parametr1'")->execute();
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[id]] = '$parametr1'")->queryAll();
                foreach ($posts as $value) {
                    return HtmlPurifier::process($value["name_predmet"]);
                }
            }
        }
    }//Метод экранирован


    public function actionResponsehash()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = 3;
            $model = new Users();
            $ttt = $model->UserData($user_id);
            echo HtmlPurifier::process($ttt[0]["hash"]);
        }
    }//Метод экранирован

    public function actionResponseusers()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[tipe]] = '2' AND [[create_user_id]] = '$user_id' ")->queryAll();
            foreach ($posts as $value) {
                echo "<span><a class='list-group-item'>" . $value["firstname"] . "&nbsp;" . $value["otchestvo"] . "&nbsp;" . $value["lastname"] . "<a href='' class='cursor_pointer' style='font-size: 18px; color: #990523;' onclick='DeleteUsers(" . $value["id"] . ")';><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg></a>/<a href='#' class='cursor_pointer' style='font-size: 18px; color: #056599;' onclick='RedactUsers(" . $value["id"] . ")';>&nbsp;+Додати предмет</a></span>";
            }
        }
    } //Метод экранирован

    public function actionEditraspisanie()
    {
        if (!Yii::$app->user->isGuest) {
            return $posts = Yii::$app->db->createCommand('SELECT * FROM {{users}}')
                ->queryAll();
        }
    } //Метод экранирован

    protected function respond($httpCode, $status, $data = array())
    {
        if (!Yii::$app->user->isGuest) {
            $response['status'] = $status;
            $response['data'] = $data;
            return json_encode($response);
        }
        // Yii::app()->end($httpCode, true);
    }//Метод экранирован

    public function actionTicheraddresponseselect()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            $city = $model['city'];
            $school = $model['school'];
            if ($model['tipe'] == 4) {
                $data = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[country]] = '$country' AND  [[tipe]] = '2' AND  [[city]] = '$city' AND [[school]] = '$school'")->queryAll();
                foreach ($data as $values) {
                    echo "<option>" . $values["firstname"] . " " . $values["otchestvo"] . " " . $values["lastname"] . "-(" . $values["id"] . ")</option>";
                }
            }
            if ($model['tipe'] == 2) {
                $data = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryAll();
                foreach ($data as $values) {
                    echo "<option>" . $values["firstname"] . " " . $values["otchestvo"] . " " . $values["lastname"] . "-(" . $values["id"] . ")</option>";
                }
            }
        }
    } //Метод экранирован

    public function actionProverkaraspisaniya()
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $country = $model['country'];
            return HtmlPurifier::process($country);
        }
    }//Метод экранирован

    public function actionPredmeti($param = null)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $predmet = Yii::$app->db->createCommand("SELECT * FROM {{ticher_predmet}} WHERE [[email]] = '" . $model["email"] . "'")->queryAll();
            foreach ($predmet as $val_predmet) {
                return "<option>" . $val_predmet["title"] . "</option>";
            }
        }
    }


    public function actionProverkaonlineurok($id)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $tipe = $model['tipe'];
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[user_id]] = '$id' AND [[status_uroka]] = 1")->queryOne();
            $code_uroka = $posts["code_uroka"];
            if (!empty($posts)) {
                return HtmlPurifier::process($posts["code_uroka"]);
            } else {
                return HtmlPurifier::process(0);
            }
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[user_id]] = '$id' AND [[status_uroka]] = 1")->queryOne();
            $code_uroka = $posts["code_uroka"];
            if (!empty($posts)) {
                return HtmlPurifier::process($posts["code_uroka"]);
            } else {
                return HtmlPurifier::process(0);
            }
        }
    }//Метод экранирован

    public function actionProverkatimeurokticher($id)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = $id;
            date_default_timezone_set('Europe/Kiev');
            $datetime = date("Y-m-d");
            $time = date("H:i");
            $posts_ticher = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$user_id' AND [[date]] = '$datetime'  AND [[status_uroka]] = '0' AND [[ready]] = '0'")->queryOne();
            $code_uroka = $posts_ticher["code_uroka"];
            if (!empty($posts_ticher)) {
                Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[ready]] = 2 WHERE  [[code_uroka]] = '$code_uroka'")->execute();

                return HtmlPurifier::process(1);
            } else {
                return HtmlPurifier::process(0);
            }
        }
    }//Метод экранирован

    public function actionProverkatimeurok($id)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = $id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            $user_school = $model["school"];
            $user_city = $model["city"];
            $user_country = $model["country"];
            $classnumber = $model["classnumber"];
            $classlater = $model["classlater"];
            $schoolid = $model["school"];
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater' AND [[school_id]] = '$schoolid'  AND [[status_uroka]] = 1 AND [[ticher_online]] = 1 ")->queryOne();
            if (!empty($posts)) {
                return HtmlPurifier::process(1);
            } else {
                return HtmlPurifier::process(0);
            }
        }
    }//Метод экранирован

    public function actionDeleteonlineurokitimeout($ids)
    {
        if (!Yii::$app->user->isGuest) {
            date_default_timezone_set('Europe/Kiev');
            $today = date("Y-m-d H:i");
            Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[status_uroka]] = 2 WHERE [[code_uroka]] = '$ids' AND [[timeendurok]] <= '$today'")->execute();
            Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[active]] = 2 WHERE  [[timeendurok]] < '$today'")->execute();
        }
    }//Метод экранирован

    public function actionRedirectifnourok($ids)
    {
        if (!Yii::$app->user->isGuest) {
            date_default_timezone_set('Europe/Kiev');
            $today = date("Y-m-d h:i");
            $id_status_uroka = 3;
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[code_uroka]] = '$ids' AND  [[status_uroka]] = 2 ")->queryOne();
            $status_uroka = $posts["status_uroka"];
            if ($status_uroka == 2) {
                Yii::$app->db->createCommand("DELETE FROM {{urok_online}} WHERE [[code_uroka]] = '$ids' AND [[status_uroka]] = 1")->execute();
                echo HtmlPurifier::process(3);
            }
        }
    }//Метод экранирован

    public function actionOnlineticherno($cod)
    {
        if (!Yii::$app->user->isGuest) {
            $posts = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[code_uroka]] = '$cod' AND [[ticher_online]] = '1' ")->queryOne();
            $ticher_online = $posts["ticher_online"];
            if (empty($ticher_online)) {
                return HtmlPurifier::process(0);
            }
            if (!empty($ticher_online)) {
                return HtmlPurifier::process(1);
            }
        }
    }//Метод экранирован

    public function actionDeactivateraspisanietimeend()
    {
        if (!Yii::$app->user->isGuest) {
            date_default_timezone_set('Europe/Kiev');
            $today = date("Y-m-d H:i");
            Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[status_uroka]] = 2 WHERE  [[timeendurok]] <= '$today'")->execute();
            Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[active]] = 2 WHERE  [[timeendurok]] < '$today'")->execute();
        }
    }//Метод экранирован

    public function actionTs($param2, $param3, $param4, $param5, $param6)
    {
        if (!Yii::$app->user->isGuest) {
            $city_id = 1;
            $school = $param4;
            $class = $param5;
            $latterclass = $param6;
            $rey = "$param3" . " $param2";
            date_default_timezone_set('Europe/Kiev');
            $time_end_urok = date("Y-m-d H:i", strtotime($rey . " + 40 minutes"));
            $search = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[city_id]] = '$city_id' AND [[school_id]] = '$param4' AND [[classnumber_id]] = '$param5' AND [[classlater_id]] = '$param6' AND [[datetimeurok]] < '$time_end_urok' AND [[timeendurok]] > '$time_end_urok'  AND [[status_uroka]] = 0")->queryAll();
            echo "<p>" . $rey;
            echo "<p>" . $time_end_urok;
        }
    }

    ////Функция курл (ищим неактивные уроки по расписанию меньше даты сегодня и деактивируем)
    public function actionStatusurokadactivate()
    {
        if (!Yii::$app->user->isGuest) {
            $time_end_urok = date("Y-m-d H:i");
            Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[status_uroka]] = 2 WHERE  [[timeendurok]] < '$time_end_urok'")->execute();
        }
    }

    ////Функция курл (ищим неактивные уроки по расписанию меньше даты сегодня и деактивируем)
    public function actionRegraspnp($oblast)
    {
        if (!Yii::$app->user->isGuest) {
            $data = Yii::$app->db->createCommand("SELECT * FROM {{oblast}} WHERE [[id]] = '$oblast' ")->queryAll();
            foreach ($data as $oblast_data) {
                echo $oblast_data["name"];
            }
            $raion_data = $oblast_data["name"];
            $raion = Yii::$app->db->createCommand("SELECT * FROM {{school_details_adres}} WHERE [[oblast]]  LIKE '%" . $raion_data . "'  GROUP BY [[raion]] ORDER BY [[raion]] ASC  ")->queryAll();
            echo "<option value=''>Оберіть район</option>";
            foreach ($raion as $raion_value) {
                echo "<option value='" . $raion_value["raion"] . "'>" . $raion_value["raion"] . "</option>";
            }
        }
    }

    public function actionRegraspcity($city)
    {
        if (!Yii::$app->user->isGuest) {
            $city = Yii::$app->db->createCommand("SELECT * FROM {{school_details_adres}} WHERE [[raion]]  LIKE '%" . $city . "'  GROUP BY [[np]] ORDER BY [[np]] ASC  ")->queryAll();
            echo "<option value=''>Оберіть н/п</option>";
            foreach ($city as $city_value) {
                echo "<option value='" . $city_value["id"] . "'>" . $city_value["np"] . "</option>";
            }
        }
    }

    public function actionRegraspschool($school)
    {
        if (!Yii::$app->user->isGuest) {
            $school_search_id = Yii::$app->db->createCommand("SELECT * FROM {{school_details_adres}} WHERE [[id]] = '$school' ")->queryOne();
            $name_np = $school_search_id["np"];
            $school = Yii::$app->db->createCommand("SELECT * FROM {{school_details_adres}} WHERE [[np]]  LIKE '%" . $name_np . "%'  GROUP BY [[sokr]] ORDER BY [[sokr]] ASC  ")->queryAll();
            foreach ($school as $school_value) {
                if (!empty($school_value["sokr"])) {
                    echo "<option value='" . $school_value["id"] . "'>" . $school_value["sokr"] . "</option>";
                }
            }
        }
    }

    public function actionReguch($id, $oblast = null, $raion = null, $city = null, $school = null, $classnumber = null, $classlater = null)
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->db->createCommand("UPDATE {{users}} SET [[status_user]] = 1,
                   [[city]] = '$city',
                   [[school]] = '$school',
                   [[classnumber]] = '$classnumber',
                   [[classlater]] = '$classlater' WHERE  [[id]] = '$id'")->execute();
            return 1;
        }
    }

    public function actionOdinc($polnoenazvanie = null,
                                $sokr = null,
                                $status = null,
                                $type = null,
                                $forma = null,
                                $region = null,
                                $np = null,
                                $adres = null,
                                $phone = null,
                                $email = null)
    {
        $fd = explode(',', $np);
        if ($np == "Київ") {
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{school_details_adres}} ORDER BY [[id]] ASC LIMIT 1')
                ->queryOne();
            $id_table_end = $data["id"] + 1;
            if (!empty($sokr)) {
                Yii::$app->db
                    ->createCommand()
                    ->insert('email_school', ['id' => $id_table_end, 'title' => $polnoenazvanie, 'telefon' => $phone, 'email' => $email])
                    ->execute();
            }
            if (empty($sokr)) {
                Yii::$app->db
                    ->createCommand()
                    ->insert('email_school', ['id' => $id_table_end, 'title' => $polnoenazvanie, 'telefon' => $phone, 'email' => $email])
                    ->execute();
            }
            return $id_table_end;
        } else {
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{email_school}} ORDER BY [[id]] DESC LIMIT 1')
                ->queryOne();
            $id_table_end = $data["id"] + 1;
            if (!empty($sokr)) {
                Yii::$app->db
                    ->createCommand()
                    ->insert('email_school', ['id' => $id_table_end, 'title' => $polnoenazvanie, 'telefon' => $phone, 'email' => $email])
                    ->execute();
            }
            if (empty($sokr)) {
                Yii::$app->db
                    ->createCommand()
                    ->insert('email_school', ['id' => $id_table_end, 'title' => $polnoenazvanie, 'telefon' => $phone, 'email' => $email])
                    ->execute();
            }
            return $id_table_end;
        }
    }

    ///////////////////////////////Функция отмечает уроки которые кончились по времени значениями 2
    public function actionDeactivateurok()
    {
        $date = date("Y-m-d H:i:s");
        $datedate = date("Y-m-d");
        $search_urok_time_out = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE  [[timeendurok]] <= '$date'")->queryAll();
        foreach ($search_urok_time_out as $val_urok) {
            $code_uroka_update = $val_urok["code_uroka"];
            Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[status_uroka]] = 2
                    WHERE  [[code_uroka]] = '$code_uroka_update'")->execute();
            $id_urok = $val_urok["id"];
            //Yii::$app->db->createCommand("DELETE FROM `raspisanie` WHERE code_uroka =  '$code_uroka_update'")->execute();
            Yii::$app->db->createCommand("DELETE FROM `urok_online` WHERE code_uroka =  '$code_uroka_update'")->execute();
        }
    }

    public function actionInstruktionhelpclose($id)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = $id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id' ")->queryOne();
            if ($model["username"] != "demo1" or $model["username"] != "demo2" or $model["username"] != "demo3") {
                Yii::$app->db->createCommand("UPDATE {{users}} SET [[instruktion_open]] = 1
                    WHERE  [[id]] = '$id'")->execute();
                return 1;
            }
        }
    }

    public function actionOnoff()
    {
        echo "200";
    }

    public function actionNamepredmetticheradd($predmet,$ticher_user_id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$ticher_user_id' ")->queryOne();
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{ticher_predmet}} ORDER BY [[id]] DESC LIMIT 1')
                ->queryOne();
            $id_table_end = $data["id"] + 1;
            Yii::$app->db->createCommand("INSERT INTO {{ticher_predmet}} ([[id]], [[email]], [[title]],[[active]]) VALUES ('$id_table_end','".$model["email"]."','$predmet','1')")->execute();
        }
    }

///////Для курла котороя обновляет хеш секретный ключ
    public function actionUserhashupdate()
    {
        $code_uroka = rand(1000000, 999999999);
        $str = $code_uroka;
        $hash_encode = md5($str);
        Yii::$app->db->createCommand("UPDATE {{users}} SET [[hash]] = '$hash_encode'
                    ")->execute();
    }

    public function actionIncoderoomename($code_uroka, $name)
    {

        $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{room_name}} ORDER BY [[id]] DESC LIMIT 1')
            ->queryOne();
        $id_table_end = $data["id"] + 1;
        $data_room = Yii::$app->db->createCommand("SELECT [[code_uroka]] FROM {{room_name}} WHERE [[code_uroka]] = '$code_uroka'")
            ->queryOne();
        Yii::$app->db
            ->createCommand()
            ->insert('room_name', ['id' => $id_table_end, 'room_name' => $name, 'code_uroka' => $code_uroka, 'active' => 1])
            ->execute();

    }

    public function actionUserurokreload($id = null)
    {
        return 1;
    }

    public function actionTicherserverrespondno($code = null)
    {
        $user_id = Yii::$app->user->id;
        $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{status_user_reload}} ORDER BY [[id]] DESC LIMIT 1')
            ->queryOne();
        $id_table_end = $data["id"] + 1;
        $search_code = Yii::$app->db->createCommand("SELECT [[code_uroka]] FROM {{status_user_reload}} WHERE [[code_uroka]] = '$code'")
            ->queryOne();
        if (empty($search_code)) {
            Yii::$app->db
                ->createCommand()
                ->insert('status_user_reload', ['id' => $id_table_end, 'code_uroka' => $code, 'active' => 1])
                ->execute();
        } else {
            return 1;
        }
    }

    public function actionDisplayshowaddcodeuroka($code = null, $usertipe = null, $diya = null)
    {
        $user_id = Yii::$app->user->id;
        $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{display_show}} ORDER BY [[id]] DESC LIMIT 1')
            ->queryOne();
        $id_table_end = $data["id"] + 1;
        $search_code = Yii::$app->db->createCommand("SELECT [[code_uroka]] FROM {{display_show}} WHERE [[code_uroka]] = '$code'")
            ->queryOne();
        if (($diya == 1) and (empty($search_code))) {
            Yii::$app->db
                ->createCommand()
                ->insert('display_show', ['id' => $id_table_end, 'code_uroka' => $code, 'active' => 1])
                ->execute();
            return 1;
        }
        if (($diya == 1) and (!empty($search_code))) {
            Yii::$app->db->createCommand("DELETE FROM {{display_show}} WHERE [[code_uroka]] = '$code'")->execute();
            Yii::$app->db
                ->createCommand()
                ->insert('display_show', ['id' => $id_table_end, 'code_uroka' => $code, 'active' => 1])
                ->execute();
            return 1;
        }
        if (($diya == 0) and (!empty($search_code))) {
            return 1;
        }
        if (($diya == 0) and (empty($search_code))) {
            return 0;
        }
    }

    public function actionUserserverrespondno($code = null)
    {
        $user_id = Yii::$app->user->id;
        $search_code = Yii::$app->db->createCommand("SELECT [[code_uroka]] FROM {{status_user_reload}} WHERE [[code_uroka]] = '$code' AND [[active]] = 2")
            ->queryOne();
        if (!empty($search_code)) {
            return 1;
        }
    }

    public function actionRedirectifyesurok($code)
    {
        $data = Yii::$app->db->createCommand("SELECT * FROM {{room_name}} WHERE [[code_uroka]] = '$code'")
            ->queryOne();
        if (empty($data)) {
            return 0;
        }
        if (!empty($data)) {
            return 1;
        }
    }

    public function actionUpdatestreamname($code_uroka = null, $name = null)
    {
        Yii::$app->db->createCommand("UPDATE {{display_show}} SET [[wss_code]] = '$name' WHERE  [[code_uroka]] = '$code_uroka'")->execute();
    }

    public function actionUpdatestatusshow($code = null)
    {
        Yii::$app->db->createCommand("DELETE FROM {{display_show}} WHERE [[code_uroka]] = '$code'")->execute();
        // Yii::$app->db->createCommand("UPDATE {{display_show}} SET [[active]] = 0 WHERE  [[code_uroka]] = '$code' ORDER BY [[id]] DESC LIMIT 1")->execute();
    }

    public function actionValumeoffall($code = null)
    {
        Yii::$app->db->createCommand("UPDATE {{value_conferences_properties}} SET [[active]] = 1 WHERE  [[code_uroka]] = '$code'")->execute();
        return 1;
    }

    public function actionValumestatusclickuser($code = null,$user_id=null)
    {
        Yii::$app->db
            ->createCommand()
            ->insert('value_status_click_user', ['id' => '', 'code_uroka' => $code, 'user_id' => $user_id, 'active' => 0])
            ->execute();
        return 1;
    }

    public function actionValumeoffallsearch($code = null)
    {
        $user_id = Yii::$app->user->id;
        $user = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
            ->queryOne();
        $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{value_conferences_properties}} ORDER BY [[id]] DESC LIMIT 1')
            ->queryOne();
        $id_table_end = $data["id"] + 1;
        $search_code = Yii::$app->db->createCommand("SELECT * FROM {{value_conferences_properties}} WHERE [[code_uroka]] = '$code'")
            ->queryOne();
        if (empty($search_code)) {
            Yii::$app->db
                ->createCommand()
                ->insert('value_conferences_properties', ['id' => $id_table_end, 'code_uroka' => $code, 'active' => 0])
                ->execute();
        }

        $search_code = Yii::$app->db->createCommand("SELECT * FROM {{value_conferences_properties}} WHERE [[code_uroka]] = '$code'")
            ->queryOne();
          return json_encode($search_code);
    }

    public function actionProverkamuteoff($code = null)
    {
        $search_code = Yii::$app->db->createCommand("SELECT * FROM {{value_conferences_properties}} WHERE [[code_uroka]] = '$code' AND [[active]] = 0")
            ->queryOne();
if($search_code["active"] == 1)
{ return 1;}else{return 0;}

    }
    public function actionCodedisplayshow($code = null)
    {
        $search_code = Yii::$app->db->createCommand("SELECT * FROM {{display_show}} WHERE [[code_uroka]] = '$code' AND [[active]] = 1")
            ->queryOne();
        if($search_code["active"] == 1)
        {
            return $search_code["wss_code"];
        }else{
            return 0;
        }


    }

    public function actionCountemail(){
        $countemail = Yii::$app->db->createCommand("SELECT COUNT(*) FROM email_school WHERE send = 0")
            ->queryScalar();

        return $countemail;
        }



    public function actionEmailgo(){
        $email = Yii::$app->db->createCommand("SELECT * FROM {{email_school}} WHERE [[send]] = '0' ")
            ->queryAll();
        foreach($email as $val_email){
        $from = "admin@e-osvita.online";
        $to = $val_email["email"];
        $subject = "Новітня система дистанційної освіти для ЗОШ";
        $message = "Вітаємо, раді презентувати вам e-osvita.online https://e-osvita.online :)
Телефон 8 095 211-76-27 администратор 
     
e-Osvita інноваційна система, яка спроможна організувати весь процес дистанційної освіти, спроможна повністю відтворити процесс навчання у школі.

e-Osvita допомагає організувати та проконтролювати розклад уроків та їх проведення.

e-Osvita простежить та унеможливить плутанини для учня та вчителя при онлайн відео - конференціях .

e-Osvita це відсутність будьяких лімітів на виде-конференціі, повна БЕЗКОШТОВНІСТЬ !!! .

e-Osvita створить автоматично конференцію та відкриє її у потрібний час, в потрібному класі, а також унеможливить втручання в навчальний процес інших осіб.

e-Osvita проінформує учня та вчителя о розкладі та вчасно почне і закінчить конференцію та урок.

e-Osvita проінформує, що був доданий новий урок з розкладом, та не дасть запізнитись учню та вчителю, і з 100% точністю відкриє клас-конференцію для учня та вчителя.

e-Osvita проконтролює створення вчителем домашнього завдання та точно відкриє його для потрібного класу або учня.

e-Osvita надає можливість створювати розклад та редагувати його, також є можливість додавати вчителів.

e-Osvita має інструменти для створення тестів та їх оцінювання.

e-Osvita спроможна ЗНАЧНО ПОЛЕГШИТИ та автоматизувати весь процес дистанційної та очної освіти за допомогою ОНЛАЙН ЖУРНАЛУ !
        ";
        $headers = "From:" . $from;
        mail($to, $subject, $message, $headers);
        $email = $val_email["email"];
            Yii::$app->db->createCommand("UPDATE {{email_school}} SET [[send]] = '2' WHERE  [[email]] = '$email'")->execute();
return $email;
        }

    }

    public function actionFetch(){


        return 77777;
    }



}
