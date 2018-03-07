<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderDispatchItems;

class CustomPickSearch extends OrderDispatchItems
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
    public function search($params)
    {
        $query = OrderDispatchItems::find()->joinWith('orderDispatch')->where(['order_type' => 'C']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['SKU','NS_sales_order','id']],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'parent_order_ID' => $this->parent_order_ID,
        ]);

        $query->andFilterWhere(['like', 'SKU',  $this->SKU])
            ->andFilterWhere(['like', 'order_dispatch.NS_sales_order', $this->NS_sales_order])
            ->andFilterWhere(['like', 'order_dispatch.id', $this->id]);

        return $dataProvider;
    }
}
