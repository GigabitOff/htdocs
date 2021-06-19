<?php

namespace app\controllers;
use yii\data\Pagination;


use Yii;
use yii\helpers\Url;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;


class MyroomController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionJornal($id_urok=null,$numberclass=null,$literaclass=null,$school=null,$date_start=null,$data_finish=null)

    {

        $date1 = Yii::$app->request->get('date1');
        $date2 = Yii::$app->request->get('date2');


        $id= Yii::$app->user->id;
        $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$id'")
            ->queryOne();
        $date_urok = date( "Y-m-d" );
        $schoolid = $model["school"];
        $classnumber = $model["classnumber"];
        $classlater = $model["classlater"];
        if(!empty($date1)) {
            if ($model["tipe"] == 3) {
                $uroki = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_urok' AND [[school_id]] = '$schoolid' AND [[classnumber_id]] = '$classnumber' AND [[status_uroka]] = '0' OR  [[status_uroka]] = '1' AND [[classlater_id]] = '$classlater' ORDER BY time ASC ")
                    ->queryAll();
            }
            if ($model["tipe"] == 2 or $model["tipe"] == 4) {
                $uroki = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_urok' AND [[ticher_id]] = '$id' AND [[active]] = '1' ")
                    ->queryAll();
            }
            if ($model["tipe"] == 2 or $model["tipe"] == 4) {
                $jornal_data_respond = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$id' AND [[classnumber_id]] = '$numberclass' AND [[classlater_id]] = '$literaclass' AND [[school_id]] = '$school' AND [[active]] = '2' AND [[date]] >= '$date1' AND [[date]] <= '$date2' ")
                    ->queryAll();
            }
            if ($model["tipe"] == 2 or $model["tipe"] == 4) {
                $jornal_data_respond_jornal = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$id' AND [[date]] >= '$date1' AND [[date]] <= '$date2'  GROUP BY [[classnumber_id]],[[classlater_id]] ")
                    ->queryAll();
            }
        }else{
            if ($model["tipe"] == 3) {
                $uroki = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_urok' AND [[school_id]] = '$schoolid' AND [[classnumber_id]] = '$classnumber' AND [[status_uroka]] = '0' OR  [[status_uroka]] = '1' AND [[classlater_id]] = '$classlater' ORDER BY time ASC ")
                    ->queryAll();
            }
            if ($model["tipe"] == 2 or $model["tipe"] == 4) {
                $uroki = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_urok' AND [[ticher_id]] = '$id' AND [[active]] = '1' ")
                    ->queryAll();
            }
            if ($model["tipe"] == 2 or $model["tipe"] == 4) {

                $jornal_data_respond = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$id' AND [[classnumber_id]] = '$numberclass' AND [[classlater_id]] = '$literaclass' AND [[school_id]] = '$school' AND [[active]] = '2'")
                    ->queryAll();
            }
            if ($model["tipe"] == 2 or $model["tipe"] == 4) {

                $jornal_data_respond_jornal = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$id' AND [[date]] >= '$date1' AND [[date]] <= '$date2'  GROUP BY [[classnumber_id]],[[classlater_id]] ")
                    ->queryAll();
            }
        }
        if ($id_urok != null) {
            $jornal_data_respond = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[id]] = '$id_urok' ")
                ->queryOne();
            $usera_details = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE  [[classnumber]] = '".$jornal_data_respond["classnumber_id"]."' AND [[classlater]] = '".$jornal_data_respond["classlater_id"]."' AND [[school]] = '".$jornal_data_respond["school_id"]."'")
                ->queryAll();
        }
        $transaction_code_security = rand(1000, 999999999);
        if ($id_urok != null) {
            $jornal_open = 1;
            return $this->render('jornal', [
                'model' => $model,
                'uroki' => $uroki,
                'jornal_data_respond' => $jornal_data_respond,
                'jornal_data_respond_jornal' => $jornal_data_respond_jornal,
                'jornal_open' => $jornal_open,
                'usera_details' => $usera_details,
                'tranzaction_code_security' => $transaction_code_security,
            ]);
        }else{
        return $this->render('jornal', [
            'model' => $model,
            'uroki' => $uroki,
            'jornal_data_respond' => $jornal_data_respond,
            'jornal_data_respond_jornal' => $jornal_data_respond_jornal,
            'tranzaction_code_security' => $transaction_code_security,
        ]);
    }}



    public function actionIndex()

    {


        $id = Yii::$app->user->id;
        $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$id'")
            ->queryOne();



        if($model["status_user"] == 0 and $model["tipe"] == 3){
            return $this->redirect('../site/registration_user?step=2&tipe=3');
        }
        if($model["status_user"] == 0 and $model["tipe"] == 4){
            return $this->redirect('../site/registration_user?step=2&tipe=4');
        }
        $date_urok = date("Y-m-d");
        $schoolid = $model["school"];
        $classnumber = $model["classnumber"];
        $classlater = $model["classlater"];
        if ($model["tipe"] == 3) {
            $uroki = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_urok' AND [[school_id]] = '$schoolid' AND [[classnumber_id]] = '$classnumber' AND [[status_uroka]] = '0' OR  [[status_uroka]] = '1' AND [[classlater_id]] = '$classlater' ORDER BY time ASC ")
                ->queryAll();
           $jornal = Yii::$app->db->createCommand("SELECT * FROM {{jurnal}} WHERE [[user_id]] = '$id'  ORDER BY [[datetimeurok]] ASC ")
                ->queryAll();

        }
        if ($model["tipe"] == 2 or $model["tipe"] == 4) {
            $uroki = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[date]] = '$date_urok' AND [[ticher_id]] = '$id' AND [[active]] = '1' ")
                ->queryAll();
        }
        if ($model["tipe"] == 2 or $model["tipe"] == 4) {
            $jornal_data = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[ticher_id]] = '$id' AND [[active]] = '2' GROUP BY [[classnumber_id]],[[classlater_id]] ")
                ->queryAll();

        }

        $transaction_code_security = rand(1000, 999999999);


        if ($model["tipe"] == 2 or $model["tipe"] == 4) {
        if (!Yii::$app->user->isGuest) {
            return $this->render('index', [
                'model' => $model,
                'uroki' => $uroki,
                'jornal_data' => $jornal_data,
                'tranzaction_code_security' => $transaction_code_security,
            ]);
        }}
        if ($model["tipe"] == 3) {

                return $this->render('index', [
                    'model' => $model,
                    'uroki' => $uroki,
                    'jornal' => $jornal,
                    'tranzaction_code_security' => $transaction_code_security,
                ]);
            }
        if (Yii::$app->user->isGuest) {
            return $this->redirect('../site/login');
        }
    } //Метод экранирован

    public function actionOnline($ids,$cod)
    {
        $user_id = Yii::$app->user->id;

        $urok = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[code_uroka]] = '$cod'")
            ->queryOne();

        $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{urok_online}} ORDER BY [[id]] DESC LIMIT 1')
            ->queryOne();
        $cod_uroka_data = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[code_uroka]] = '$cod'")
            ->queryOne();

        $id_table_end = $data["id"] + 1;

            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                ->queryOne();
            if($model["tipe"] == 2) {
if(empty($cod_uroka_data)){
                Yii::$app->db
                    ->createCommand()
                    ->insert('urok_online', ['id' => $id_table_end, 'school_id' => $urok["school_id"], 'user_id' => $ids, 'ticher_id' => $urok["ticher_id"], 'time' => $urok["time"], 'date' => $urok["date"], 'classnumber_id' => $urok["classnumber_id"], 'classlater_id' => $urok["classlater_id"], 'timeendurok' => $urok["timeendurok"], 'status_uroka' => 1, 'active' => $urok["active"], 'code_uroka' => $cod])
                    ->execute();

                Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[status_uroka]] = 1   WHERE [[code_uroka]] = '$cod'")->execute();
                Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[active]] = 2   WHERE [[code_uroka]] = '$cod'")->execute();
            }}

        return $this->render('online');
    }//Метод экранирован

    public function actionOnlinestart($ids,$cod)
    {
        $user_id = Yii::$app->user->id;

        $urok = Yii::$app->db->createCommand("SELECT * FROM {{raspisanie}} WHERE [[code_uroka]] = '$cod'")
            ->queryOne();

        $data = Yii::$app->db->createCommand('SELECT [[id]] FROM {{urok_online}} ORDER BY [[id]] DESC LIMIT 1')
            ->queryOne();
        $cod_uroka_data = Yii::$app->db->createCommand("SELECT * FROM {{urok_online}} WHERE [[code_uroka]] = '$cod'")
            ->queryOne();
        $id_table_end = $data["id"] + 1;

            $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
                ->queryOne();
            if($model["tipe"] == 2) {
                if(empty($cod_uroka_data)){
                Yii::$app->db
                    ->createCommand()
                    ->insert('urok_online', ['id' => $id_table_end, 'school_id' => $urok["school_id"], 'user_id' => $ids, 'ticher_id' => $urok["ticher_id"], 'time' => $urok["time"], 'date' => $urok["date"], 'classnumber_id' => $urok["classnumber_id"], 'classlater_id' => $urok["classlater_id"], 'timeendurok' => $urok["timeendurok"], 'status_uroka' => 1, 'active' => $urok["active"], 'code_uroka' => $cod])
                    ->execute();

                Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[status_uroka]] = 1   WHERE [[code_uroka]] = '$cod'")->execute();
                Yii::$app->db->createCommand("UPDATE {{raspisanie}} SET [[active]] = 2   WHERE [[code_uroka]] = '$cod'")->execute();
            }}

        return $this->render('onlinestart', [
            'urok' => $urok,
        ]);

    }//Метод экранирован
}
