<?php

namespace app\controllers;

use Yii;
use app\models\OrderDispatchItems;
use app\models\SingleBulkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * SinglebulkController implements the CRUD actions for OrderDispatchItems model.
 */
class SinglebulkController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderDispatchItems models.
     * @return mixed
     */
    public function actionSample() {
        if(Yii::$app->request->isAjax) {
            $session = Yii::$app->session;
            $data = Yii::$app->request->post();
            $sel = $data['sel'];
            $flag = $data['flag'];
            if( strcmp($flag,"add") == 0) {
                if(!isset($_SESSION['checked_array']))
                {
                    $_SESSION['checked_array'] = array();
                }
                array_push($_SESSION['checked_array'],$sel);
                $arrays = $_SESSION['checked_array'];
                $_SESSION['checked_array'] = array_unique($arrays);
                $session['checked_array1'] = $_SESSION['checked_array'];
            } else {
                $arrays = $_SESSION['checked_array'];
                $del = array_search($sel,$arrays);
                unset($arrays[$del]);
                $_SESSION['checked_array'] = $arrays;
                $session['checked_array1'] = $_SESSION['checked_array'];
            }
            echo json_encode($_SESSION['checked_array']);
        }

        /*
        if(Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $sel = $data['sel'];
        //    unset($_SESSION['checked_array']);
            if(!isset($_SESSION['checked_array']))
            {
                $_SESSION['checked_array'] = array();
            }
            $arrays = array_merge($_SESSION['checked_array'],$sel);
            $_SESSION['checked_array'] = array_unique($arrays);
            echo json_encode($_SESSION['checked_array']);
        }*/
    }
    public function actionIndex()
    {
        if(yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('warning','You did not login. Please login!');
            return $this->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        }
        $selection = (array) Yii::$app->request->post('selection');
        $select = (array) Yii::$app->request->get('selection');
    //    var_dump($select);
        $model = new SingleBulkSearch();
        //when click only wave generation button
        if(isset($_POST['singlebulk_flag']) && $_POST['singlebulk_flag'] == '1'){
            $model->insertItemsIntoWaves_WavesItems($selection);
            $session = Yii::$app->session;
            unset($session['checked_array1']);
            unset($_SESSION['checked_array']);
        } else {
        //    Yii::$app->session;
        /*    if(!isset($_SESSION['checked_array']))
            {
                $_SESSION['checked_array'] = array();
            }
            $arrays = array_merge($_SESSION['checked_array'],$selection);
            $_SESSION['checked_array'] = array_unique($arrays);
            var_dump($_SESSION['checked_array']);*/
        }
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => "SELECT parent_order_ID, CONCAT(SKU, '(',COUNT(SKU), ')') AS SKU1,SKU,COUNT(SKU) AS COUNT,wl.warehouse_name AS location FROM order_dispatch_items od JOIN warehouse_locations wl ON wl.warehouse_id = od.location WHERE od.status LIKE 'U'  GROUP BY SKU",
            'pagination' => [
                'pageSize' =>50,
            ],
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderDispatchItems model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrderDispatchItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderDispatchItems();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderDispatchItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderDispatchItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderDispatchItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderDispatchItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderDispatchItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
