<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderDispatchItems;
use yii\db\Query;

class SingleBulkSearch extends OrderDispatchItems
{

    public $NS_sales_order;
    // You have to set NS_sales_order as safe to show filter box
    public function rules()
    {
        return [
            [['id', 'parent_order_ID', 'quantity', 'wave_number'], 'integer'],
            [['SKU', 'location', 'status', 'time_printed', 'date_printed','NS_sales_order'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$loc)
    {
        /*SELECT parent_order_ID,SKU,COUNT(SKU), CONCAT(SKU, '(',COUNT(SKU), ')') FROM order_dispatch_items GROUP BY SKU*/
        /*SELECT od.*,oi.* FROM order_dispatch_items od JOIN order_dispatch oi ON od.parent_order_ID = oi.id WHERE oi.order_type LIKE "S"*/
        $this->load($params);
        $connection = \Yii::$app->db;
        $model = $connection->createCommand("SELECT parent_order_ID, CONCAT(SKU, '(',COUNT(SKU), ')') AS SKU FROM order_dispatch_items od JOIN order_dispatch oi ON od.parent_order_ID = oi.id  GROUP BY SKU");

        $dataProvider = $model->queryAll();
        return $dataProvider;
    }

    public function getLocation()
    {
        $connection = \Yii::$app->db;
        $model = $connection->createCommand('SELECT id,warehouse_name FROM warehouse_locations WHERE id IN (SELECT location FROM order_dispatch_items WHERE STATUS LIKE "U" GROUP BY location) GROUP BY id');

        $locations = $model->queryAll();
        return $locations;
    }
}
