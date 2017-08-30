<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VValidasiPembayaran;

/**
 * CariDataSearch represents the model behind the search form about `app\models\VValidasiPembayaran`.
 */
class CariData extends VValidasiPembayaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tgl_trip', 'waktu_booking', 'waktu_exp', 'waktu_konfirmasi','nama_pengirim','jumlah_kirim'], 'safe'],
            [['id_destinasi', 'id_customer', 'total_pax', 'biaya_trip', 'biaya_jemput', 'biaya_antar', 'total_biaya', 'id_status'], 'integer'],
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
        $query = VValidasiPembayaran::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                'waktu_konfirmasi' => SORT_DESC,
                ],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
 $query->andFilterWhere([
        'id' => $this->id,
        //'group_id' => $this->group_id,
    ]);
        // grid filtering conditions
        $query->andFilterWhere([
            //'id'=>$this->id,
            'id_destinasi' => $this->id_destinasi,
            'id_customer' => $this->id_customer,
            'tgl_trip' => $this->tgl_trip,
            //'waktu_booking' => $this->waktu_booking,
            //'waktu_exp' => $this->waktu_exp,
            'total_pax' => $this->total_pax,
            'biaya_trip' => $this->biaya_trip,
            'biaya_jemput' => $this->biaya_jemput,
            'biaya_antar' => $this->biaya_antar,
            'total_biaya' => $this->total_biaya,
            'id_status' => $this->id_status,
           // 'waktu_konfirmasi' => $this->waktu_konfirmasi,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id]);
        $query->andFilterWhere(['like', 'nama_pengirim', $this->nama_pengirim]);
        $query->andFilterWhere(['like', 'waktu_booking', $this->waktu_booking]);
        $query->andFilterWhere(['like', 'waktu_exp', $this->waktu_exp]);
        $query->andFilterWhere(['like', 'waktu_konfirmasi', $this->waktu_konfirmasi]);

        return $dataProvider;
    }
}
