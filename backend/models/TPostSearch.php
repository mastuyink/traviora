<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TPost;

/**
 * TPostSearch represents the model behind the search form about `app\models\TPost`.
 */
class TPostSearch extends TPost
{
    public $cari;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'id_author'], 'integer'],
            [['judul_content', 'content', 'create_at', 'last_update','cari'], 'safe'],
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
        $query = TPost::find();

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
            'id_author' => $this->id_author,
            'create_at' => $this->create_at,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'judul_content', $this->judul_content])
        ->andFilterWhere(['like', 'judul_content', $this->cari])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}