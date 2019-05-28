<?php
//  ==========  LAST MODIFIED   :   2019-05-28  ==========
//  update : try to implement session to forbid access to HOME page if user has not login yet but still got error, all addition code has been commented
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
            //  ==========  ADDED BY AJENG  ==========
            // 'auth' => [
            //     'class' => 'yii\authclient\AuthAction',
            //     'successCallback' => [$this, 'onAuthSuccess'],
            // ],  
            //  ==========  END OF EDIT ==========
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    //  ==========  ADDED BY AJENG  ==========
    // public function onAuthSuccess($client)
    // {
    //    $attributes = $client->getUserAttributes();

    //     /** @var Auth $auth */
    //     $auth = Auth::find()->where([
    //         'source' => $client->getId(),
    //         'source_id' => $attributes['id'],
    //     ])->one();

    //     if (Yii::$app->user->isGuest) {
    //         if ($auth) { // login
    //             $user = $auth->user;
    //             Yii::$app->user->login($user);
    //         } else { // signup
    //             if (User::find()->where(['email' => $attributes['email']])->exists()) {
    //                 Yii::$app->getSession()->setFlash('error', [
    //                     Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
    //                 ]);
    //             } else {
    //                 $password = Yii::$app->security->generateRandomString(6);
    //                 $user = new User([
    //                     'username' => $attributes['login'],
    //                     'email' => $attributes['email'],
    //                     'password' => $password,
    //                 ]);
    //                 $user->generateAuthKey();
    //                 $user->generatePasswordResetToken();
    //                 $transaction = $user->getDb()->beginTransaction();
    //                 if ($user->save()) {
    //                     $auth = new Auth([
    //                         'user_id' => $user->id,
    //                         'source' => $client->getId(),
    //                         'source_id' => (string)$attributes['id'],
    //                     ]);
    //                     if ($auth->save()) {
    //                         $transaction->commit();
    //                         Yii::$app->user->login($user);
    //                     } else {
    //                         print_r($auth->getErrors());
    //                     }
    //                 } else {
    //                     print_r($user->getErrors());
    //                 }
    //             }
    //         }
    //     } else { // user already logged in
    //         if (!$auth) { // add auth provider
    //             $auth = new Auth([
    //                 'user_id' => Yii::$app->user->id,
    //                 'source' => $client->getId(),
    //                 'source_id' => $attributes['id'],
    //             ]);
    //             $auth->save();
    //         }
    //     }
    // }
    //  ==========  END OF EDIT ==========

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
        // if (Yii::$app->user->isGuest) {
        //     return $this->render('index');
        // }
        // else {
        //     $model = new LoginForm();
        //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //         return $this->goBack();
        //     }
        //     $model->password = '';
        //     return $this->render('login', [
        //         'model' => $model,
        //     ]);
        // }
        // return $this->render('index');
        // if (Yii::$app->user->isGuest) {
        //     return $this->render('index');
        //     // return $this->goHome();
        // }
        // if (!Yii::$app->user->isGuest) {
        //     $model = new LoginForm();
        //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //         return $this->goBack();
        //     }

        // $model->password = '';
        // return $this->render('login', [
        //     'model' => $model,
        // ]);
        //     // return $this->goHome();
        // }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //  ==========  ADDED BY AJENG  ==========
        //  back to login page after logout
        // $model = new LoginForm();
        // if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //     return $this->goBack();
        // }

        // $model->password = '';
        // return $this->render('login', [
        //     'model' => $model,
        // ]);
        //  ==========  END OF EDIT ==========
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
