<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderDispatch;

/**
 * CustomPickSearch represents the model behind the search form of `app\models\OrderDispatch`.
 */
class CustomPickSearch extends OrderDispatch
{
    /**
     * {@inheritdoc}
     */
    public $SKU;
    public function rules()
    {
        return [
            [['NS_sales_order', 'shipping_address', 'shipping_method', 'status', 'order_type','SKU'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
        $query = OrderDispatch::find()->where(['order_type' => 'Custom']);
        $query->joinWith('orderDispatchItems');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'id' => $this->id,
            'order_priority' => $this->order_priority,
        ]);

        $query->andFilterWhere(['like', 'NS_sales_order', $this->NS_sales_order])
            ->andFilterWhere(['like', 'shipping_address', $this->shipping_address])
            ->andFilterWhere(['like', 'shipping_method', $this->shipping_method])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'order_dispatch_items.SKU', $this->SKU])
            ->andFilterWhere(['like', 'order_type', $this->order_type]);

        return $dataProvider;
    }
}
