<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_kode_hari".
 *
 * @property integer $id
 * @property string $nama_hari
 *
 * @property THariTrip[] $tHariTrips
 * @property THariTrip[] $tHariTrips0
 * @property THariTrip[] $tHariTrips1
 * @property THariTrip[] $tHariTrips2
 * @property THariTrip[] $tHariTrips3
 * @property THariTrip[] $tHariTrips4
 * @property THariTrip[] $tHariTrips5
 */
class TKodeHari extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kode_hari';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_hari'], 'required'],
            [['nama_hari'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama_hari' => Yii::t('app', 'Nama Hari'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips()
    {
        return $this->hasMany(THariTrip::className(), ['id_jumat' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips0()
    {
        return $this->hasMany(THariTrip::className(), ['id_kamis' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips1()
    {
        return $this->hasMany(THariTrip::className(), ['id_minggu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips2()
    {
        return $this->hasMany(THariTrip::className(), ['id_rabu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips3()
    {
        return $this->hasMany(THariTrip::className(), ['id_sabtu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips4()
    {
        return $this->hasMany(THariTrip::className(), ['id_selasa' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrips5()
    {
        return $this->hasMany(THariTrip::className(), ['id_senin' => 'id']);
    }
}
