<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_biaya".
 *
 * @property integer $id
 * @property integer $biaya_dewasa
 * @property integer $biaya_anak
 * @property integer $biaya_bayi
 * @property string $datetime
 *
 * @property TBiayaKhusus[] $tBiayaKhususes
 * @property TSesiBiaya[] $tSesiBiayas
 */
class TBiaya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_biaya';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['biaya_dewasa', 'biaya_anak', 'biaya_bayi'], 'required'],
            [['biaya_dewasa', 'biaya_anak', 'biaya_bayi'], 'integer'],
            [['datetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'biaya_dewasa' => Yii::t('app', 'Biaya Dewasa'),
            'biaya_anak' => Yii::t('app', 'Biaya Anak'),
            'biaya_bayi' => Yii::t('app', 'Biaya Bayi'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBiayaKhususes()
    {
        return $this->hasMany(TBiayaKhusus::className(), ['id_biaya' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSesiBiayas()
    {
        return $this->hasMany(TSesiBiaya::className(), ['id_biaya' => 'id']);
    }
}
