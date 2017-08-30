<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_lokasi_aj".
 *
 * @property integer $id
 * @property string $lokasi_aj
 * @property integer $biaya
 *
 * @property TAntar[] $tAntars
 * @property TJemput[] $tJemputs
 */
class TLokasiAj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_lokasi_aj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lokasi_aj'], 'required'],
            //[['biaya'], 'integer'],
            [['lokasi_aj'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lokasi_aj' => 'Lokasi Aj',
           // 'biaya' => 'Biaya',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAntars()
    {
        return $this->hasMany(TAntar::className(), ['id_lokasi_antar' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTJemputs()
    {
        return $this->hasMany(TJemput::className(), ['id_lokasi_jemput' => 'id']);
    }
}
