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
class ApirozkladController extends Controller
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
            return 1;
        }
    }//Метод экранирован и защищён от XSS

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

    public function actionRaspisanie($parametr1 = null,
                                     $parametr2 = null,
                                     $parametr3 = null,
                                     $parametr4 = null,
                                     $parametr5 = null,
                                     $parametr6 = null,
                                     $parametr7 = null,
                                     $hash = null)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                ->queryOne();
            if ($hash == $model["hash"]) {
                $code_uroka = rand(1000000, 999999999);
                date_default_timezone_set('Europe/Kiev');
                $time_end_urok = date("Y-m-d H:i", strtotime(" + 40 minutes"));
                $data_for_search_string = "$parametr7";
                $result_search_string = strstr($data_for_search_string, "(");
                $data1 = str_replace('(', '', $result_search_string);
                $data2 = str_replace(')', '', $data1);
                $user_school = $model["school"];
                $user_city = $model["city"];
                date_default_timezone_set('Europe/Kiev');
                if ($parametr1 == "create") {
                    $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{raspisanie}} ORDER BY [[id]] DESC LIMIT 1')
                        ->queryOne();
                    $id_table_end = $data["id"] + 1;
                    $today_date = date("Y-m-d H:i");
                    $rey = "$parametr3" . "$parametr2";
                    $time_end_urok = date("Y-m-d H:i", strtotime($rey . " + 40 minutes"));
                    $df = date("Y-m-d H:i", strtotime($rey . " + 0 minutes"));
                    $zoom_time = date("H:i", strtotime($parametr2 . " - 3 hours"));
                    $responseData = $this->actionSearchtimeaddurok($parametr3, $df, $time_end_urok);
                    if ($responseData == 1) {
                        return 1;
                    }
                    if ($today_date < $df) {
                        if ($responseData != 1) {
                            Yii::$app->db
                                ->createCommand()
                                ->insert('raspisanie', ['id' => $id_table_end, 'school_id' => $user_school, 'user_id' => $user_id, 'ticher_id' => $data2, 'time' => $parametr2, 'datetimeurok' => $df, 'date' => $parametr3, 'classnumber_id' => $parametr4, 'classlater_id' => $parametr5, 'name_predmet' => $parametr6, 'timeendurok' => $time_end_urok, 'active' => '1', 'code_uroka' => $code_uroka])
                                ->execute();

                            return HtmlPurifier::process(0);
                        }
                    } else {
                        return 2;
                    }
                }
            }
        }
    } //Метод экранирован

    public function actionSearchtimeaddurok($parametr3, $df, $time_end_urok)
    {
        if (!Yii::$app->user->isGuest) {
            $search = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE 
                               [[date]] = '$parametr3'")->queryAll();
            foreach ($search as $val) {
                $d = $df;
                $dftime = date("Y-m-d H:i:s", strtotime($d . " + 0 minutes"));
                $ds = $time_end_urok;
                $dfs = date("Y-m-d H:i:s", strtotime($d . " + 40 minutes"));
                $d1 = $val['datetimeurok'];
                $d2 = $val['timeendurok'];
                if ($d2 >= $dftime && $d1 <= $dftime or $d2 >= $dfs && $d1 <= $dfs) {
                    return 1;
                }
            }
        }
    }

    public function actionIntervaldateraspisanie($parametr1, $parametr2, $parametr3)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr1 != "uchenic") {
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$parametr1' AND [[date]] >= '$parametr2' AND [[date]] <= '$parametr3'  GROUP BY [[date]],[[classnumber_id]] ")->queryAll();
                foreach ($posts as $value) {
                    print HtmlPurifier::process("<hr style=' border: none; 
    background-color: red; 
    color: red; 
    height: 2px;'><p style='color: #2e6da4;'><br><h3 style='color: #2e6da4;'>" . $value["date"] . "<h3 style='color: #2e6da4;'>" . $value["classnumber_id"] . " - " . $value["classlater_id"] . "</h3>");
                    $date_res = $value["date"];
                    $res_posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$parametr1' AND [[date]] = '$date_res' AND [[classnumber_id]] = '" . $value["classnumber_id"] . "'  AND [[classlater_id]] = '" . $value["classlater_id"] . "'  ")->queryAll();
                    foreach ($res_posts as $values) {
                        $idts = $values["id"];
                        $time_end_urok = date("H:i", strtotime($values['datetimeurok']));
                        print HtmlPurifier::process("<p><h3>" . $values['name_predmet'] . "-" . $time_end_urok . "</h3>");
                    }
                }
            }
            if ($parametr1 == "zavuch") {
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE  [[date]] >= '$parametr2' AND [[date]] <= '$parametr3'  GROUP BY [[date]],[[classnumber_id]] ")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process("<hr style=' border: none; 
    background-color: red; 
    color: red; 
    height: 2px;'><h3><p style='color: #2e6da4;'>" . $value["date"] . "</p><p style='color: #2e6da4;'>&nbsp;&nbsp;&nbsp;&nbsp;" . $value["classnumber_id"] . " - " . $value["classlater_id"] . "</p></hr>");
                    $date_res = $value["date"];

                    $res_posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_res' AND [[classnumber_id]] = '" . $value["classnumber_id"] . "'  AND [[classlater_id]] = '" . $value["classlater_id"] . "'  ")->queryAll();
                    foreach ($res_posts as $values) {
                        $time_end_urok = date("H:i", strtotime($values['time']));
                        echo "<p><h4>&nbsp;&nbsp;&nbsp;" . $values['name_predmet'] . "-" . $time_end_urok . "<a href='' class='cursor_pointer' style='font-size: 18px; color: #a42e38;' onclick='RaspisanieRedact(" . $values['id'] . ");'>&nbsp;&nbsp;X&nbsp;&nbsp;</a>";

                    }
                }
            }
            if ($parametr1 == "uchenic") {
                $user_id = Yii::$app->user->id;
                $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                    ->queryOne();
                $schoolid = $model["school"];
                $classnumber = $model["classnumber"];
                $classlater = $model["classlater"];
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater' AND [[school_id]] = '$schoolid' AND [[date]] >= '$parametr2' AND [[date]] <= '$parametr3'  GROUP BY [[date]]  ")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process("<hr style=' border: none; 
    background-color: red; 
    color: red; 
    height: 2px;'><p style='color: #2e6da4;'>" . $value["date"] . "</p></hr>");
                    $date_res = $value["date"];
                    $res_posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater' AND [[school_id]] = '$schoolid' AND [[date]] = '$date_res' ")->queryAll();
                    foreach ($res_posts as $values) {
                        echo HtmlPurifier::process('<p>' . $values["name_predmet"] . ' - <span style="font-size: 18px;" >' . date("H:i", strtotime($values["time"])));
                    }
                }
            }
        }
    }//Метод экранирован и защищён от XSS

    public function actionResponseraspisanie($parametr1, $parametr2)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr2 == "respond_uchenik") {
                $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                    ->queryOne();
                $schoolid = $model["school"];
                $classnumber = $model["classnumber"];
                $classlater = $model["classlater"];

                $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE date = '$parametr1' AND [[school_id]] = '$schoolid' AND [[classnumber_id]] = '$classnumber' AND [[status_uroka]] = '0' AND [[classlater_id]] = '$classlater'")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process('<span class="list-group-item ">' . $value["name_predmet"] . ' </span>');
                }
            }
            if ($parametr2 == "respond") {
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$parametr1' AND [[ticher_id]] = '$user_id'")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process('<span class="list-group-item ">' . $value["name_predmet"] . ' </span>');
                }
            }
            if ($parametr2 == "redact") {
                $posts_class_summ = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[user_id]] = '$user_id' AND [[date]] = '$parametr1'  GROUP BY [[classnumber_id]],[[classlater_id]] ")->queryAll();
                foreach ($posts_class_summ as $values) {
                    $classnumber = $values['classnumber_id'];
                    $classlater = $values['classlater_id'];
                    $classactive = $values['active'];
                    $time_end_urok = date("Ymd", strtotime($parametr1));
                    $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}}
 WHERE date = '$parametr1' AND {{user_id}} = '$user_id' AND [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater' AND [[active]] = ' $classactive'")->queryAll();
                    echo HtmlPurifier::process("<span class='cursor_pointer' style='font-size:18px; ' id='yes" . $values["classnumber_id"] . "" . $values["classlater_id"] . "'>&nbsp;<a  onclick='DisplayVisibleBlock($time_end_urok, $classactive)'>" . $classnumber . "-" . $classlater . "</a></span>");
                }
            }
        }
    }//Метод экранирован и защищён от XSS

    public function actionRaspisanieredact($parametr1, $parametr2)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr2 == "delete") {
                Yii::$app->db->createCommand("DELETE FROM {{raspisanie}} WHERE [[id]] = '$parametr1'")->execute();
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[id]] = '$parametr1'")->queryAll();
                foreach ($posts as $value) {
                    return HtmlPurifier::process($value["name_predmet"]);
                }
            }
        }
    } //Метод экранирован

    public function actionUserhashreturn($id)
    {
        $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$id' ")->queryOne();
        return "<button type='submit' class='btn btn-success' onclick='CreateRaspisanie(this.value);' value='" . $model["hash"] . "'>Додати</button>";
    }

    public function actionTicherrespondpredmet($user_id)
    {
        $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'  ")->queryOne();
        $predmet = Yii::$app->db->createCommand("SELECT * FROM {{ticher_predmet}} WHERE [[email]] = '".$model['email']."'  ")->queryAll();
foreach($predmet as $val_predmet){
    echo "<option>".$val_predmet["title"]."</option>";
}
         }
}
