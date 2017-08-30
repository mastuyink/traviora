<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jemput".
 *
 * @property integer $id
 * @property string $id_booking
 * @property integer $id_area_jemput
 * @property integer $id_metode_jemput
 * @property integer $id_jam_jemput
 * @property string $alamat_jemput
 * @property string $no_telp_jemput
 * @property integer $biaya_jemput
 * @property string $datetime
 *
 * @property TAreaAj $idAreaJemput
 * @property TBooking $idBooking
 * @property TWaktuJemput $idJamJemput
 * @property TJenisTarifAj $idMetodeJemput
 */
class TJemput extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jemput';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_booking'], 'required'],
            [['id_area_jemput', 'id_metode_jemput', 'id_jam_jemput', 'no_telp_jemput', 'biaya_jemput'], 'integer'],
            [['datetime'], 'safe'],
            [['id_booking'], 'string', 'max' => 5],
            [['alamat_jemput'], 'string', 'max' => 100],
            [['id_area_jemput'], 'exist', 'skipOnError' => true, 'targetClass' => TAreaAj::className(), 'targetAttribute' => ['id_area_jemput' => 'id']],
            [['id_booking'], 'exist', 'skipOnError' => true, 'targetClass' => TBooking::className(), 'targetAttribute' => ['id_booking' => 'id']],
            [['id_jam_jemput'], 'exist', 'skipOnError' => true, 'targetClass' => WaktuJemput::className(), 'targetAttribute' => ['id_jam_jemput' => 'id']],
            [['id_metode_jemput'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisTarifAj::className(), 'targetAttribute' => ['id_metode_jemput' => 'id']],
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
            'id_area_jemput' => Yii::t('app', 'Id Area Jemput'),
            'id_metode_jemput' => Yii::t('app', 'Id Metode Jemput'),
            'id_jam_jemput' => Yii::t('app', 'Id Jam Jemput'),
            'alamat_jemput' => Yii::t('app', 'Alamat Jemput'),
            'no_telp_jemput' => Yii::t('app', 'No Telp Jemput'),
            'biaya_jemput' => Yii::t('app', 'Biaya Jemput'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAreaJemput()
    {
        return $this->hasOne(TAreaAj::className(), ['id' => 'id_area_jemput']);
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
    public function getIdJamJemput()
    {
        return $this->hasOne(WaktuJemput::className(), ['id' => 'id_jam_jemput']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMetodeJemput()
    {
        return $this->hasOne(TJenisTarifAj::className(), ['id' => 'id_metode_jemput']);
    }
}
