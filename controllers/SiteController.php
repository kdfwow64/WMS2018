<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SinglePickOrdersForm;
use app\models\WavenumForm;
use app\models\Wavenum1Form;
use app\models\Wavenum2Form;
use app\models\OrderDispatch;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function actionSingle()
    {
        $model = new OrderDispatch();
    
        // if the post data is set, the user submitted the form
        if ($model->load(Yii::$app->request->post())) {
            
            // in that case, validate the data
            if ($model->validate()) {
                
                // save it to the database
                $model->save();     
                return;
            }
        }
    
        // by default, diplay the form
        return $this->render('single', [
            'model' => $model,
        ]);
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

    /**
     * @inheritdoc
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
    // Single Pick Orders
    public function actionSinglepickorders() { 
        $db = new yii\db\Connection(Yii::$app->db);
        $sql = "Select o.id,o.NS_sales_order,o.order_type,oi.SKU FROM order_dispatch o join order_dispatch_items oi on o.id = oi.parent_order_ID where o.order_type like 'Single'";
        $limit = 3;

        $from =   (isset($_GET['page'])) ? ($_GET['page']-1)*$limit : 0;
        $result =   $db->createCommand($sql.' LIMIT '.$from.','.$limit)->queryAll();
        $count   = $db->createCommand('SELECT COUNT(*) as total FROM ('.$sql.') a')->queryScalar();

        $pagination = new \yii\data\Pagination(['totalCount' => $count, 'pageSize' => $limit]);             
        return $this->render('singlepickorders', [
            'models' => $result,
            'pagination' => $pagination,
        ]);
    }
    public function actionMultipickorders()
    {
        return $this->render('multipickorders');
    }
    public function actionPersonalisedorders()
    {
        return $this->render('personalisedorders');
    }
    public function actionCustomfitorders()
    {
        return $this->render('customfitorders');
    }
    public function actionWorkflowprocessingwaves()
    {
        $model = new WavenumForm(); // only wavenum
        $model1 = new Wavenum1Form(); // wavenum and verify
        $model4 = new Wavenum2Form(); // wavenum,wave, verify
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...
            $model2 = new Wavenum1Form();
            $model2->wavenum = $model->wavenum;
            return $this->render('workflowprocessingwaves2', ['model' => $model2]);
        } 
        if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
            // either the page is initially displayed or there is some validation error
            $model5 = new Wavenum2Form();
            $model5->wavenum = $model1->wavenum;
            $model5->verify = $model1->verify;
            return $this->render('workflowprocessingwaves3', ['model' => $model5]);
        }
        if ($model4->load(Yii::$app->request->post()) && $model4->validate()) {
            // either the page is initially displayed or there is some validation error
            return $this->render('workflowprocessingwaves4', ['model' => $model4]);
        }
        return $this->render('workflowprocessingwaves1', ['model' => $model]);
    }
    public function actionWaveprintout()
    {
        return $this->render('waveprintout');
    }
}
