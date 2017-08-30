<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TarifAj;

/**
 * Caritarif represents the model behind the search form about `app\models\TarifAj`.
 */
class Caritarif extends TarifAj
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'id_area', 'id_jenis_tarif', 'tarif_pax', 'tarif_car'], 'integer'],
            [['datetime'], 'safe'],
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
        $query = TarifAj::find();

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
            'id_area' => $this->id_area,
            'id_jenis_tarif' => $this->id_jenis_tarif,
            
            'tarif_pax' => $this->tarif_pax,
            'tarif_car' => $this->tarif_car,
            'datetime' => $this->datetime,
        ]);

        return $dataProvider;
    }
}
