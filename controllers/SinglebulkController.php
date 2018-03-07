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

    public function actionWave()
    {
        $selection = (array) Yii::$app->request->post('selection');
        $model = new SingleBulkSearch();
        $model->setStatus($selection);
        return Yii::$app->runAction('singlebulk/index');
    }
    public function actionIndex()
    {
        if(yii::$app->user->isGuest)
        {
            echo "<script type='text/javascript'>alert('Please login!');</script>";
            return $this->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        }
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => "SELECT parent_order_ID, CONCAT(SKU, '(',COUNT(SKU), ')') AS SKU1,SKU,COUNT(SKU) AS COUNT FROM order_dispatch_items od JOIN order_dispatch oi ON od.parent_order_ID = oi.id WHERE od.status LIKE 'U'  GROUP BY SKU",
            'pagination' => [
                'pageSize' =>50,
            ],
        ]);
        if(isset($_POST['sel_location'])){
            $req = Yii::$app->request;
            $loc = $req->post('sel_location');

            $dataProvider = new SqlDataProvider([
                'db' => Yii::$app->db,
                'sql' => "SELECT parent_order_ID, CONCAT(SKU, '(',COUNT(SKU), ')') AS SKU1,SKU,COUNT(SKU) AS COUNT FROM order_dispatch_items od JOIN order_dispatch oi ON od.parent_order_ID = oi.id WHERE od.location = ".$loc."  GROUP BY SKU",
                'pagination' => [
                    'pageSize' =>50,
                ],
            ]);
        }
        $model = new SingleBulkSearch(); 
        $locations = $model->getLocation();
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'locations' =>$locations,
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
