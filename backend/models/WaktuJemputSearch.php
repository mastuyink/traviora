<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WaktuJemput;

/**
 * WaktuJemputSearch represents the model behind the search form about `app\models\WaktuJemput`.
 */
class WaktuJemputSearch extends WaktuJemput
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'id_lokasi_aj'], 'integer'],
            [['start_time', 'end_time', 'datetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = WaktuJemput::find();

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
            'id_destinasi' => $this->id_destinasi,
            'id_lokasi_aj' => $this->id_lokasi_aj,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'datetime' => $this->datetime,
        ]);

        return $dataProvider;
    }
}
