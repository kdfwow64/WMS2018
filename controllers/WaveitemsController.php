<?php

namespace app\controllers;

use Yii;
use app\models\WaveItems;
use app\models\WaveitemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;
use Dompdf\Dompdf;
use kartik\mpdf\Pdf;
/**
 * WaveitemsController implements the CRUD actions for WaveItems model.
 */
class WaveitemsController extends Controller
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
     * Lists all WaveItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('warning','You did not login. Please login!');
            return $this->redirect(Yii::$app->urlManager->createUrl('/site/login'));
        }
        /*
        SELECT parent_wave_number,SUM(quantity) FROM wave_items GROUP BY parent_wave_number
        */
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => "SELECT parent_wave_number AS wave_number,SUM(wave_items.quantity) AS quantities, SUM(sku) AS SKU_count FROM wave_items LEFT JOIN ( SELECT COUNT(DISTINCT SKU) AS sku, parent_order_ID FROM order_dispatch_items GROUP BY parent_order_ID ) AS a
    ON wave_items.order_dispatch_id = a.parent_order_ID
    GROUP BY  parent_wave_number",
            'pagination' => [
                'pageSize' =>50,
            ],
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPrint()
    {
        $wavenum = Yii::$app->request->get('id');
        $dataProvider = new SqlDataProvider([
            'db' => Yii::$app->db,
            'sql' => "SELECT b.*,od.SKU FROM 
    (SELECT a.item_id AS item, a.quantity,a.NS_sales_order,a.addr1,warehouse_locations.warehouse_name AS location 
        FROM (SELECT wave_items.*,order_dispatch.NS_sales_order,order_dispatch.addr1  
            FROM wave_items JOIN order_dispatch ON wave_items.order_dispatch_id = order_dispatch.id WHERE wave_items.parent_wave_number = ".$wavenum.") AS a 
            JOIN warehouse_locations ON a.location_id = warehouse_locations.warehouse_id) AS b 
                JOIN order_dispatch_items od ON b.item = od.id",
            'pagination' => [
                'pageSize' =>50,
            ],
        ]);
        $content = $this->renderPartial('print',['dataProvider'=>$dataProvider,'wavenum' => $wavenum]);
        $pdf = new Pdf([
            'mode'=>Pdf::MODE_UTF8,
            'format'=>Pdf::FORMAT_A4,
            'content'=> $content,
            'options'=>['title'=>'Print Page'],
            'methods'=>[
                'SetFooter'=>['{PAGENO}']
            ]
        ]);
        return $pdf->render();
/*
        return $this->render('print',[
            'dataProvider' => $dataProvider,
            'wavenum' => $wavenum
        ]);*/
    }

    /**
     * Displays a single WaveItems model.
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
     * Creates a new WaveItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WaveItems();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WaveItems model.
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
     * Deletes an existing WaveItems model.
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
     * Finds the WaveItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WaveItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WaveItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
