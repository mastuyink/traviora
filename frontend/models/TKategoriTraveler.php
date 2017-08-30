<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_kategori_traveler".
 *
 * @property integer $id
 * @property string $jenis
 *
 * @property TTraveler[] $tTravelers
 */
class TKategoriTraveler extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kategori_traveler';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jenis'], 'required'],
            [['id'], 'integer'],
            [['jenis'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis' => 'Jenis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTravelers()
    {
        return $this->hasMany(TTraveler::className(), ['id_jenis_anggota' => 'id']);
    }
}
