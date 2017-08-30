<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TSesiBiaya;

/**
 * TSesiBiayaSearch represents the model behind the search form about `app\models\TSesiBiaya`.
 */
class TSesiBiayaSearch extends TSesiBiaya
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'id_jenis_sesi', 'id_biaya'], 'integer'],
            [['tgl_mulai', 'tgl_selesai', 'datetime'], 'safe'],
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
        $query = TSesiBiaya::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                'id_destinasi' => SORT_ASC,
                'id_jenis_sesi' => SORT_ASC
                ],
            ]
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
            'id_jenis_sesi' => $this->id_jenis_sesi,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
            'id_biaya' => $this->id_biaya,
            'datetime' => $this->datetime,
        ]);

        return $dataProvider;
    }
}
