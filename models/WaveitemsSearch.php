<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WaveItems;

/**
 * WaveitemsSearch represents the model behind the search form of `app\models\WaveItems`.
 */
class WaveitemsSearch extends WaveItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_wave_number', 'order_dispatch_id', 'location_id', 'bin_location_id', 'item_id', 'quantity'], 'integer'],
            [['license_plate', 'status'], 'safe'],
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
        $query = WaveItems::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'parent_wave_number' => $this->parent_wave_number,
            'order_dispatch_id' => $this->order_dispatch_id,
            'location_id' => $this->location_id,
            'bin_location_id' => $this->bin_location_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'license_plate', $this->license_plate])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
