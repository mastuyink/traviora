<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jenis_hari_trip".
 *
 * @property integer $id
 * @property string $jenis_hari_trip
 *
 * @property THariTrip[] $tHariTrips
 */
class TJenisHariTrip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenis_hari_trip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_hari_trip'], 'required'],
            [['jenis_hari_trip'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jenis_hari_trip' => Yii::t('app', 'Jenis Hari Trip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips()
    {
        return $this->hasMany(THariTrip::className(), ['id_jenis_hari_trip' => 'id']);
    }
}
