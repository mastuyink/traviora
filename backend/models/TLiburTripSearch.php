<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TLiburTrip;

/**
 * TLiburTripSearch represents the model behind the search form about `app\models\TLiburTrip`.
 */
class TLiburTripSearch extends TLiburTrip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi'], 'integer'],
            [['tgl_libur', 'datetime'], 'safe'],
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
        $query = TLiburTrip::find();

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
            'tgl_libur' => $this->tgl_libur,
            'datetime' => $this->datetime,
        ]);

        return $dataProvider;
    }
}
