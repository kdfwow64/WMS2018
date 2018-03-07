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

    public function setStatus($params)
    {
        //ALTER TABLE waves AUTO_INCREMENT = 1000000
        $count = 0;
        $date1 = new \yii\db\Expression('NOW()');
        for($i =0 ;$i<sizeof($params); $i++){
            Yii::$app->db->createCommand("UPDATE order_dispatch_items SET status = 'P' WHERE SKU LIKE '".$params[$i]."' ")->query();
            $count1 = Yii::$app->db->createCommand("SELECT COUNT(SKU) FROM order_dispatch_items WHERE SKU LIKE  '".$params[$i]."'  ")->queryScalar();
            $count +=$count1;
        }
        //add a row into waves table
        if($count>0){
            Yii::$app->db->createCommand("INSERT INTO waves (number_order_dispatch_in_wave,printed_timestamp) VALUES (".$count.",'".$date1."')")->query();
        }
        //get wave id
        $count = Yii::$app->db->createCommand("SELECT MAX(id) FROM waves")->queryScalar();
        //add rows into wave_items
        for($i =0 ;$i<sizeof($params); $i++){

            $rows = Yii::$app->db->createCommand("SELECT * FROM order_dispatch_items WHERE SKU LIKE  '".$params[$i]."'  ")->queryAll();
            foreach($rows as $row){
                Yii::$app->db->createCommand("INSERT INTO wave_items (order_dispatch_id,quantity,location_id,parent_wave_number) VALUES (".$row['parent_order_ID'].",'".$row['quantity']."','".$row['location']."',".$count.")")->query();
            }
        }
    }
}
