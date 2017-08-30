<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_antar".
 *
 * @property integer $id
 * @property string $id_booking
 * @property integer $id_area_antar
 * @property integer $id_metode_antar
 * @property integer $id_jam_antar
 * @property string $alamat_antar
 * @property string $no_telp_antar
 * @property integer $biaya_antar
 * @property string $datetime
 *
 * @property TAreaAj $idAreaAntar
 * @property TBooking $idBooking
 * @property TWaktuJemput $idJamAntar
 * @property TJenisTarifAj $idMetodeAntar
 */
class TAntar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_antar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_booking'], 'required'],
            [['id_area_antar', 'id_metode_antar', 'id_jam_antar', 'no_telp_antar', 'biaya_antar'], 'integer'],
            [['datetime'], 'safe'],
            [['id_booking'], 'string', 'max' => 5],
            [['alamat_antar'], 'string', 'max' => 100],
            [['id_area_antar'], 'exist', 'skipOnError' => true, 'targetClass' => TAreaAj::className(), 'targetAttribute' => ['id_area_antar' => 'id']],
            [['id_booking'], 'exist', 'skipOnError' => true, 'targetClass' => TBooking::className(), 'targetAttribute' => ['id_booking' => 'id']],
            [['id_jam_antar'], 'exist', 'skipOnError' => true, 'targetClass' => TWaktuJemput::className(), 'targetAttribute' => ['id_jam_antar' => 'id']],
            [['id_metode_antar'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisTarifAj::className(), 'targetAttribute' => ['id_metode_antar' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_booking' => Yii::t('app', 'Id Booking'),
            'id_area_antar' => Yii::t('app', 'Id Area Antar'),
            'id_metode_antar' => Yii::t('app', 'Id Metode Antar'),
            'id_jam_antar' => Yii::t('app', 'Id Jam Antar'),
            'alamat_antar' => Yii::t('app', 'Alamat Antar'),
            'no_telp_antar' => Yii::t('app', 'No Telp Antar'),
            'biaya_antar' => Yii::t('app', 'Biaya Antar'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAreaAntar()
    {
        return $this->hasOne(TAreaAj::className(), ['id' => 'id_area_antar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBooking()
    {
        return $this->hasOne(TBooking::className(), ['id' => 'id_booking']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJamAntar()
    {
        return $this->hasOne(TWaktuJemput::className(), ['id' => 'id_jam_antar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMetodeAntar()
    {
        return $this->hasOne(TJenisTarifAj::className(), ['id' => 'id_metode_antar']);
    }
}
