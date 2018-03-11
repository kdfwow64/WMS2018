<?php

namespace app\controllers;

use Yii;
use app\models\OrderDispatchItems;
use app\models\MultiPickSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

/**
 * MultiPickController implements the CRUD actions for OrderDispatchItems model.
 */
class MultiController extends Controller
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
    public function actionIndex()
    {
        if(yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('warning','You did not login. Please login!');
            return $this->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        }
//        $selection = (array) Yii::$app->request->post('selection');
//        $model = new SingleBulkSearch();
//        $model->insertItemsIntoWaves_WavesItems($selection);
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => "SELECT parent_order_ID, CONCAT(SKU, '(',COUNT(SKU), ')') AS SKU1,SKU,COUNT(SKU) AS COUNT,wl.warehouse_name AS location FROM order_dispatch_items od JOIN warehouse_locations wl ON wl.warehouse_id = od.location WHERE od.status LIKE 'U'  GROUP BY SKU HAVING COUNT(*) > 1",
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
