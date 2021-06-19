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
class ApidzController extends Controller
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

    public function actionDz($parametr2, $parametr3, $parametr4, $parametr5, $parametr6, $parametr7, $hash = null)
    {
        if (!Yii::$app->user->isGuest) {
            date_default_timezone_set('Europe/Kiev');
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                ->queryOne();
            if (!empty($parametr2) or !empty($parametr3) or !empty($parametr4) or !empty($parametr5) or !empty($parametr6) or !empty($parametr7)) {
                if ($hash == $model["hash"]) {
                    $school_id = $model["school"];
                    $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{dz}} ORDER BY [[id]] DESC LIMIT 1')
                        ->queryOne();
                    $id_table_end = $data["id"] + 1;
                    Yii::$app->db
                        ->createCommand()
                        ->insert('dz', ['id' => $id_table_end, 'user_id' => $user_id, 'school_id' => $school_id, 'ticher_id' => $user_id, 'time' => $parametr2, 'date' => $parametr3, 'classnumber_id' => $parametr4, 'classlater_id' => $parametr5, 'name_predmet' => $parametr6, 'text' => $parametr7])
                        ->execute();
                    return HtmlPurifier::process($id_table_end);
                }
            } else {
                return 0;
            }
        }
    } //Метод экранирован

    public function actionUserhashreturndz($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$id' ")->queryOne();
            return "<button type='submit' class='btn btn-success' onclick='CreateDZ(this.value);' value='" . $model["hash"] . "'>Cтворити</button>";
        }
    }

    public function actionIntervaldatedz($parametr1, $parametr2, $parametr3)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr1 != "uchenic") {
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[ticher_id]] = '$parametr1' AND [[date]] >= '$parametr2' AND [[date]] <= '$parametr3'  GROUP BY [[date]]  ")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process("<hr style=' border: none; 
    background-color: red; 
    color: red; 
    height: 2px;'><p style='color: #2e6da4;'>" . $value["date"] . "</p></hr>");
                    $date_res = $value["date"];
                    $res_posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[ticher_id]] = '4' AND [[date]] = '$date_res' ")->queryAll();
                    foreach ($res_posts as $values) {
                        echo HtmlPurifier::process('<div class="listgroupitemDZ">
    <input type="checkbox" id="hd-' . $values["id"] . '" class="hide"/>
    <label style="margin-top:17px;" for="hd-' . $values["id"] . '" >' . $values["name_predmet"] . '</label>
    <div>
       ' . $values["text"] . '
         </div>
    <br/>
    <br/> 
</div>');
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
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater' AND [[school_id]] = '$schoolid' AND [[date]] >= '$parametr2' AND [[date]] <= '$parametr3'  GROUP BY [[date]]  ")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process("<hr style=' border: none; 
    background-color: red; 
    color: red; 
    height: 2px;'><p style='color: #2e6da4;'>" . $value["date"] . "</p></hr>");
                    $date_res = $value["date"];
                    $res_posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater' AND [[school_id]] = '$schoolid' AND [[date]] = '$date_res' ")->queryAll();
                    foreach ($res_posts as $values) {
                        echo HtmlPurifier::process('<div class="listgroupitemDZ">
    <input type="checkbox" id="hd-' . $values["id"] . '" class="hide"/>
    <label style="margin-top:17px;" for="hd-' . $values["id"] . '" >' . $values["name_predmet"] . '</label>
    <div>
       ' . $values["text"] . '
         </div>
    <br/>
    <br/> 
</div>');
                    }
                }
            }
        }
    }//Метод экранирован и защищён от XSS

    public function actionResponsedz($parametr1, $parametr2)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            if ($parametr2 = "uchenik") {
                $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                    ->queryOne();
                $schoolid = $model["school"];
                $classnumber = $model["classnumber"];
                $classlater = $model["classlater"];
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[date]] = '$parametr1' AND [[school_id]] = '$schoolid' AND [[classnumber_id]] = '$classnumber' AND [[classlater_id]] = '$classlater'")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process('<div class="listgroupitemDZ">
    <input type="checkbox" id="hd-' . $value["id"] . '" class="hide"/>
    <hr style=" border: none; 
    background-color: red; 
    color: red; 
    height: 2px;"><label style="margin-top:17px;" for="hd-' . $value["id"] . '" >' . $value["name_predmet"] . '</label>
    <div>
       ' . $value["text"] . '
         </div>
    <br/>
    <br/> 
</div></hr>');
                }
            }
            if ($parametr2 = "ticher") {
                $posts = Yii::$app->db->createCommand("SELECT * FROM {{dz}} WHERE [[user_id]] = '$user_id' AND [[date]] = '$parametr1'")->queryAll();
                foreach ($posts as $value) {
                    echo HtmlPurifier::process('<div class="listgroupitemDZ">
    <input type="checkbox" id="hd-' . $value["id"] . '" class="hide"/>
    <label style="margin-top:17px;" for="hd-' . $value["id"] . '" >' . $value["name_predmet"] . '</label>
    <div>
       ' . $value["text"] . '
         </div>
    <br/>
    <br/>
</div>');
                }
            }
        }
    }//Метод экранирован и защищён от XSS
}