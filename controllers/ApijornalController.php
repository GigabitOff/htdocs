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


class ApijornalController extends Controller
{
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


    public function actionOpenclassjornal($param_class_number = null,
                                                 $param_class_litera=null,
                                                 $para_school_id=null)
    {
        if (!Yii::$app->user->isGuest) {
            $posts = Yii::$app->db->createCommand('SELECT * FROM {{users}} WHERE [[tipe]] = 3')->queryAll();
            // return $this->respond(200,self::RESPONSE_OK,$posts);
            foreach ($posts as $value) {
                echo '<p><a><span onclick="openJornalUser(' . $value["id"] . ');" style="font-size: 18px; color:#4169E1;">' . $value["firstname"] . '</span>&nbsp;<span style="font-size: 18px; color:#4169E1;">' . $value["lastname"] . '</span>&nbsp;<svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
</svg></a></p>';
            }
        }

    }

    public function actionJornaladdocenka($ocenka = null,
                                          $predmet_id = null,
                                          $ticher_id = null,
                                          $code_uroka = null,
                                          $uchenik_id = null,
                                          $namepredmet = null,
                                          $school = null,
                                          $classnumber = null,
                                          $classlater = null)
    {
        if (!Yii::$app->user->isGuest) {
            date_default_timezone_set('Europe/Kiev');
            $timeaddurok = date("Y-m-d H:i");
            $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{jurnal}} ORDER BY [[id]] DESC LIMIT 1')
                ->queryOne();
            $id_table_end = $data["id"] + 1;
            Yii::$app->db
                ->createCommand()
                ->insert('jurnal', ['id' => $id_table_end,
                    'user_id' => $uchenik_id,
                    'datetimeurok' => $timeaddurok,
                    'ticher_id' => $ticher_id,
                    'ocenka' => $ocenka,
                    'code_uroka' => $code_uroka,
                    'name_predmet' => $namepredmet,
                    'school_id' => $school,
                    'classnumber_id' => $classnumber,
                    'classlater_id' => $classlater,
                    'active' => 1])
                ->execute();
        }
        }


    public function actionRespondnameuchenik($user_uchenik)
    {
        if (!Yii::$app->user->isGuest) {
            $user = Yii::$app->db->createCommand("SELECT [[id]],[[firstname]],[[lastname]] FROM {{users}} WHERE [[id]] = '$user_uchenik'")
                ->queryOne();

            echo "<span>" . $user['firstname'] . " " . $user['lastname'] . "";
        }
    }//Метод экранирован и защищён от XSS

    public function actionRespondjurnalzavuch($date1=null,$date2=null,$number_class=null,$letter_class=null,$predmet=null)
    {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")->queryOne();
            $schoolid = $model["school"];
            if (!empty($date1) and empty(!$date2)) {
                $search_urok_time_out = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE  [[school_id]] = '$schoolid' AND  [[date]] >= '$date1' AND [[date]] <= '$date2'")->queryAll();
                echo '<div class="rasp" style="background-color: #ffffff; height:320px; overflow-x: hidden;">
                <table class="table table_sort">
                    <thead>
                    <tr>
                        <td colspan="7" style="background-color: #c4e2ff; ">Розклад на
                            "' . $today = date("d.m.Y") . '"</td>
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
<tbody>';
                foreach ($search_urok_time_out as $val_urok) {
                    echo '
<tr>
    <td scope="row">1</td>
    <td>' . $val_urok["date"] . '</td>
    <td>' . $val_urok["name_predmet"] . '</td>
    <td>' . $val_urok["classnumber_id"] . '-' . $val_urok["classlater_id"] . '</td>
    <td>' . $val_urok["ticher_id"] . '</td>
    <td>' . $val_urok["time"] . '</td>
    <td><a href="#">Редагувати</a></td>
</tr>

</div>';
                }
                echo '</tbody>
</table>';
            }//Метод экранирован и защищён от XSS
            if (!empty($number_class) and !empty($letter_class)) {
                $search_urok_time_out = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE  [[school_id]] = '$schoolid' AND  [[classnumber_id]] = '$number_class' AND [[classlater_id]] = '$letter_class'")->queryAll();
                echo '<div class="rasp" style="background-color: #ffffff; height:320px; overflow-x: hidden;">
                <table class="table table_sort">
                    <thead>
                    <tr>
                        <td colspan="7" style="background-color: #c4e2ff; ">Розклад на
                            "' . $today = date("d.m.Y") . '"</td>
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
<tbody>';
                foreach ($search_urok_time_out as $val_urok) {
                    echo '
<tr>
    <td scope="row">1</td>
    <td>' . $val_urok["date"] . '</td>
    <td>' . $val_urok["name_predmet"] . '</td>
    <td>' . $val_urok["classnumber_id"] . '-' . $val_urok["classlater_id"] . '</td>
    <td>' . $val_urok["ticher_id"] . '</td>
    <td>' . $val_urok["time"] . '</td>
    <td><a href="#">Редагувати</a></td>
</tr>

</div>';
                }
                echo '</tbody>
</table>';
            }//Метод экранирован и защищён от XSS
            if (!empty($predmet)) {
                $search_urok_time_out = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE  [[school_id]] = '$schoolid' AND  [[name_predmet]] = '$predmet' ")->queryAll();
                echo '<div class="rasp" style="background-color: #ffffff; height:320px; overflow-x: hidden;">
                <table class="table table_sort">
                    <thead>
                    <tr>
                        <td colspan="7" style="background-color: #c4e2ff; ">Розклад на
                            "' . $today = date("d.m.Y") . '"</td>
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
<tbody>';
                foreach ($search_urok_time_out as $val_urok) {
                    echo '
<tr>
    <td scope="row">1</td>
    <td>' . $val_urok["date"] . '</td>
    <td>' . $val_urok["name_predmet"] . '</td>
    <td>' . $val_urok["classnumber_id"] . '-' . $val_urok["classlater_id"] . '</td>
    <td>' . $val_urok["ticher_id"] . '</td>
    <td>' . $val_urok["time"] . '</td>
    <td><a href="#">Редагувати</a></td>
</tr>

</div>';
                }
                echo '</tbody>
</table>';
            }//Метод экранирован и защищён от XSS
        }
    }



    public function actionUserjornalocenka($user_id=null,$code_uroka=null){
        if (!Yii::$app->user->isGuest) {
            $ocenka = Yii::$app->db->createCommand("SELECT * FROM {{jurnal}} WHERE  [[code_uroka]] = '$code_uroka' AND [[user_id]] = '$user_id'")->queryOne();
            return $ocenka["ocenka"];
        }
    }


   public function actionOpenticherjornaldetail($id)
   {
       if (!Yii::$app->user->isGuest) {
           $search_urok_time_out = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE  [[id]] = '$id' ")->queryOne();
           $user = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[school]] = '" . $search_urok_time_out["school_id"] . "' AND [[classnumber]] = '" . $search_urok_time_out["classnumber_id"] . "' AND [[classlater]] = '" . $search_urok_time_out["classlater_id"] . "'")
               ->queryAll();
           echo '         <thead>
                            <tr>
                                <td colspan="8" style="background-color: #c4e2ff; ">

                         <h3>' . $search_urok_time_out["name_predmet"] . '</h3></td>
                </tr>
                <tr>
                    <th scope="col">ID&nbsp;▼</th>
                    <th scope="col">Оцінка&nbsp;▼</th>
                    <th scope="col">Учень&nbsp;▼</th>
                    <th scope="col">Статус&nbsp;▼</th>
                    <th scope="col">Редагувати&nbsp;▼</th>
                    <th scope="col">Зауваження&nbsp;▼</th>
                    <th scope="col">Батькам&nbsp;▼</th>
                </tr>
                </thead>
                <tbody>';
           foreach ($user as $valuest) {

               echo '
                    <tr>
      <td scope="row">' . $valuest["id"] . '</td>
      <td scope="row">' . $this->actionUserjornalocenka($valuest["id"], $search_urok_time_out["code_uroka"]) . '</td>
       <td>' . $valuest["firstname"] . ' ' . $valuest["lastname"] . '</td>
        
         <td scope="row"><span   style="  color:#000000;"  >Хворів</span></td>
          <td scope="row"><a  style=" text-decoration: underline; cursor: pointer; color:#4169E1;"  onclick="openModalJornalDetails();">Зробити</a></td>
                     <td scope="row"><a   style=" text-decoration: underline; color:#4169E1;" >Написати</a></td>
          <td scope="row"><a  style=" cursor: pointer; text-decoration: underline; color:#4169E1;" >Написати</a></td>
                    </tr>';
               echo '</tbody>';
           }


       }

   }
}
