<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\RegistrationForm;
use app\models\Forgot;


class SiteController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()

    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('../myroom/index');
        }

        return $this->render('index');
    }


    /**
     * Login action.
     *
     * @return Response|string
     */

    public function actionLogin($demo = null, $forgotpass=null)
    {
        if (!Yii::$app->user->isGuest) { return $this->goHome();}
        $model = new Users();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect('../myroom/index');

        }

        if ($demo == 1) {
            return $this->render('login', [
                'model' => $model,
                'demo' => $demo
            ]);
        }
        if ($demo == null) {
            $demo = 0;
            $forgotpassyes = $forgotpass;
            if($forgotpassyes == "forgot" ){$forgotpassyes = 1;}
            return $this->render('login', [
                'model' => $model,
                'demo' => $demo,
                'forgotpassyes' => $forgotpassyes
            ]);
        }
    }

    public function actionDemo()
    {
        $model = new Users();
        if ($model->load(Yii::$app->request->post())
            && $model->login()) {
            return $this->redirect('../index');
        }
        return $this->render('demo', [
            'model' => $model,
        ]);
    }

    public function actionRegistrationuchenik()
    {
        $model = new RegistrationForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new Users();
            $model->username;
            $model->password;
            Yii::$app->db
                ->createCommand()
                ->insert('users', ['username' => $model->username,
                        'password' => $model->password,
                        'tipe' => 3,
                        'firstname' => $model->firstname,
                        'lastname' => $model->lastname,
                        'email' => $model->email,
                        'telefon' => $model->telefon]
                )
                ->execute();
            // return $this->redirect('../site/registration?step=2');
            return $this->redirect('../site/login');
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    public function actionRegistrationschool()
    {


        $model = new RegistrationForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new Users();
            $model->username;
            $model->password;
            Yii::$app->db
                ->createCommand()
                ->insert('users', ['username' => $model->username,
                        'password' => $model->password,
                        'tipe' => 4,
                        'firstname' => $model->firstname,
                        'lastname' => $model->lastname,
                        'email' => $model->email,
                        'telefon' => $model->telefon]
                )
                ->execute();
            return $this->redirect('../site/login');
        }

        return $this->render('registrationzavuch', [
            'model' => $model,
        ]);
    }

    public function actionRegistration_user($step = null, $tipe = null)
    {
        $user_id = Yii::$app->user->id;
        $model_user = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
            ->queryOne();
        if($model_user["status_user"] != 0){return $this->redirect('../index');}
        if ($step == 2 and $tipe == 3) {
            $model = new RegistrationForm();
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                $user = new Users();
                $model->username;
                $model->password;
                Yii::$app->db
                    ->createCommand()
                    ->insert('users', ['username' => $model->username,
                            'password' => $model->password,
                            'tipe' => 3,
                            'firstname' => $model->firstname,
                            'lastname' => $model->lastname,
                            'email' => $model->email,
                            'telefon' => $model->telefon]
                    )
                    ->execute();
                return $this->redirect('../site/login');
            }
        }
        if ($step == 2 and $tipe == 4) {
            $model = new RegistrationForm();
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                $user = new Users();
                $model->username;
                $model->password;
                Yii::$app->db
                    ->createCommand()
                    ->insert('users', ['username' => $model->username,
                            'password' => $model->password,
                            'tipe' => 4,
                            'firstname' => $model->firstname,
                            'lastname' => $model->lastname,
                            'email' => $model->email,
                            'telefon' => $model->telefon]
                    )
                    ->execute();
                return $this->redirect('../site/login');
            }
        }
        if ($step == 2) {
            return $this->render('finish', [
                'model' => $model,
                'tipe' => $tipe
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
       // return $this->redirect('../site/login');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        $user_id = Yii::$app->user->id;
        $model_user = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
            ->queryOne();


        return $this->render('contact', [
            'model' => $model,
            'model_user' => $model_user,
        ]);
    }

    public function actionInstruction()
    {

        $user_id = Yii::$app->user->id;
        $model = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[id]] = '$user_id'")
            ->queryOne();

        return $this->render('instruction', [
            'model' => $model,
        ]);
    }

    public function actionPresentation()
    {

        return $this->render('presentation');
    }

    public function actionForgotpass($email=null)
    {
        $model = new Forgot();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()){
            $email = $model->email;
        $user_id = Yii::$app->user->id;
        $pochta = Yii::$app->db->createCommand("SELECT * FROM {{users}} WHERE [[email]] = '$email'")->queryOne();
        if($email == $pochta["email"]) {
            $ds = rand(22222, 3453454);
            $from = "admin@e-osvita.online";
            $to = $pochta["email"];
            $subject = "Нагадування пароля";
            $message = $pochta["password"];
            $headers = "From:" . $from;
            mail($to, $subject, $message, $headers);
            return $this->redirect('../site/login?forgotpass=forgot');
        }else{return $this->redirect('../site/forgotpass?email=no');}
    }
        return $this->render('forgot',[
        'model' => $model,
            'email' => $email,
            ]);
    }


    public function actionTest($email=null)
    {
        return $this->render('test');

    }

    public function actionEmailgo()
    {
        return $this->render('emailgo');
    }




}
