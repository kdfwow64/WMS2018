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
use app\models\Wavenum3Form;
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
        if(yii::$app->user->isGuest)
            return $this->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        return $this->redirect(Yii::$app->urlManager->createUrl('/site/workflowprocessingwaves'));
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
        //    Yii::$app->session->setFlash('warning','go back');
            return $this->goBack();
        }

        $model->user_pass = '';
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
        if(yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('warning','You did not login. Please login!');
            return $this->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        }

        $available_count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM wave_items WHERE status LIKE 'G' ")->queryScalar();
        if($available_count==0)
            Yii::$app->session->setFlash('warning','You have nothing to change!');
        $model = new WavenumForm(); // only wavenum
        $model1 = new Wavenum1Form(); // wavenum and verify
        $model4 = new Wavenum2Form(); // wavenum,wave, verify
        $model7 = new Wavenum3Form(); 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...
            $model2 = new Wavenum1Form();
            $model2->wavenum = $model->wavenum;
            $row = Yii::$app->db->createCommand("SELECT * FROM wave_items WHERE status LIKE 'G' AND parent_wave_number = ".$model2->wavenum)->queryOne();
            if(!$row) {
                Yii::$app->session->setFlash('warning','Please input correct Wave number!');
                $model->wavenum = "";
                return $this->render('workflowprocessingwaves1', ['model' => $model]);
            } else {
                $bin_location = Yii::$app->db->createCommand("SELECT bin_location FROM bin_locations WHERE warehouse_id = ".$row['bin_location_id'])->queryScalar();
                $model2->wavenum = $model->wavenum;
                $model2->bin = $bin_location;
                $model2->item_id = $row['item_id'];
                $model2->quantity = $row['quantity'];
                return $this->render('workflowprocessingwaves2', ['model' => $model2]); 
            }
        }
        if ($model1->load(Yii::$app->request->post())) {
            // either the page is initially displayed or there is some validation error
            if(strcmp($model1->bin,$model1->verify) != 0) {
                Yii::$app->session->setFlash('warning',"It doesn't match!");
                $model1->verify = "";
                return $this->render('workflowprocessingwaves2', ['model' => $model1]);
            } else {
                $model5 = new Wavenum2Form();
                $model5->wavenum1 = $model1->wavenum;
                $model5->bin1 = $model1->bin;
                $model5->item_id1 = $model1->item_id;
                $model5->item1 =  Yii::$app->db->createCommand("SELECT SKU FROM order_dispatch_items WHERE id = ".$model1->item_id)->queryScalar();
                $model5->quantity1 = $model1->quantity;
                return $this->render('workflowprocessingwaves3', ['model' => $model5]);
            }
        }
        if ($model4->load(Yii::$app->request->post())) {
            if(strcmp($model4->item1,$model4->verify1) != 0) {
                Yii::$app->session->setFlash('warning',"It doesn't match!");
                $model4->verify1 = "";
                return $this->render('workflowprocessingwaves3', ['model' => $model4]);
            } else {
                $model8 = new Wavenum3Form();
                $model8->wavenum2 = $model4->wavenum1;
                $model8->bin2 = $model4->bin1;
                $model8->item2 = $model4->item1;
                $model8->quantity2 = $model4->quantity1;
                $model8->item_id2 = $model4->item_id1;
                return $this->render('workflowprocessingwaves4', ['model' => $model8]);
            }
        }
        if ($model7->load(Yii::$app->request->post())) {
            if(empty($model7->plate))
                $model7->plate = rand(1000000000,9999999999);
            Yii::$app->db->createCommand("UPDATE wave_items SET license_plate = '".$model7->plate."' , status = 'P' WHERE parent_wave_number = ".$model7->wavenum2." AND item_id = ".$model7->item_id2)->query();
            $count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM wave_items WHERE status = 'G' ")->queryScalar();
            // Anything to change further?
            if($count != 0) {
                $model9 = new WavenumForm;
                $count_same = Yii::$app->db->createCommand("SELECT COUNT(*) FROM wave_items WHERE status = 'G' AND parent_wave_number = ".$model7->wavenum2)->queryScalar();
                //Same wave number items exist?
                if($count_same != 0 ) {
                    $mode = new Wavenum1Form();
                    $mode->wavenum = $model7->wavenum2;
                    $row = Yii::$app->db->createCommand("SELECT * FROM wave_items WHERE status LIKE 'G' AND parent_wave_number = ".$mode->wavenum)->queryOne();

                    $bin_location = Yii::$app->db->createCommand("SELECT bin_location FROM bin_locations WHERE warehouse_id = ".$row['bin_location_id'])->queryScalar();
                    $mode->bin = $bin_location;
                    $mode->item_id = $row['item_id'];
                    $mode->quantity = $row['quantity'];
                    Yii::$app->session->setFlash('success',"Successfully Changed! Please try with the save Wave!");
                    return $this->render('workflowprocessingwaves2', ['model' => $mode]);

                } else {
                    Yii::$app->session->setFlash('success',"Successfully Changed! Please try another Wave!");
                    return $this->render('workflowprocessingwaves1', ['model' => $model9]);
                }
            } else {
                Yii::$app->session->setFlash('success',"Successfully Changed! You have nothing to do now. ");
            }
        }
        return $this->render('workflowprocessingwaves1', ['model' => $model]);
    }
    public function actionWaveprintout()
    {
        return $this->render('waveprintout');
    }
}
