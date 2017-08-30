<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TDestinasi;

/**
 * TDestinasiSearch represents the model behind the search form about `app\models\TDestinasi`.
 */
class TDestinasiSearch extends TDestinasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','id_supplier', 'id_jenis_destinasi', 'jatah_seat', 'stok_seat', 'seat_terjual','id_status'], 'integer'],
            [['nama_destinasi', 'timestamp'], 'safe'],
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
        $query = TDestinasi::find()->indexBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                'id_supplier' => SORT_ASC,
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
            'id_supplier' => $this->id_supplier,
            'id_jenis_destinasi' => $this->id_jenis_destinasi,
            'jatah_seat' => $this->jatah_seat,
            'stok_seat' => $this->stok_seat,
            'seat_terjual' => $this->seat_terjual,
            'id_status'=>$this->id_status,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'nama_destinasi', $this->nama_destinasi]);

        return $dataProvider;
    }
}
