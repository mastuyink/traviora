<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AreaAj;

/**
 * CariArea represents the model behind the search form about `app\models\AreaAj`.
 */
class CariArea extends AreaAj
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_lokasi_aj'], 'integer'],
            [['nama_area', 'datetime'], 'safe'],
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
        $query = AreaAj::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                'datetime' => SORT_DESC,
            ]
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
            'id_lokasi_aj' => $this->id_lokasi_aj,
            'datetime' => $this->datetime,
        ]);

        $query->andFilterWhere(['like', 'nama_area', $this->nama_area]);

        return $dataProvider;
    }
}
