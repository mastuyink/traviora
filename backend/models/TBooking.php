<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_booking".
 *
 * @property string $id
 * @property integer $id_destinasi
 * @property integer $id_customer
 * @property string $tgl_trip
 * @property string $waktu_booking
 * @property string $waktu_exp
 * @property integer $total_pax
 * @property integer $biaya_trip
 * @property integer $biaya_jemput
 * @property integer $biaya_antar
 * @property integer $total_biaya
 * @property integer $id_status
 * @property string $timestamp
 *
 * @property TAntar[] $tAntars
 * @property TCustomer $idCustomer
 * @property TDestinasi $idDestinasi
 * @property TStatusOrder $idStatus
 * @property TJemput[] $tJemputs
 * @property TPembayaran[] $tPembayarans
 */
class TBooking extends \yii\db\ActiveRecord
{
    public $dewasa       = 0;
    public $anak         = 0;
    public $bayi         = 0;
    public $biaya_dewasa = 0;
    public $biaya_anak   = 0;
    public $biaya_bayi   = 0;
    public $total_ajem   = 0;
    public $id_pembayaran;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'tgl_trip', 'total_pax', 'biaya_trip', 'total_biaya'], 'required', 'message' => 'Harus Di Isi'],
            [['id_destinasi', 'id_customer', 'total_pax', 'biaya_trip', 'biaya_jemput', 'biaya_antar', 'total_biaya', 'id_status','dewasa','anak','bayi'], 'integer'],
           
            [['tgl_trip', 'waktu_booking', 'waktu_exp', 'timestamp'], 'safe'],
            [['id'], 'string', 'max' => 5],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => TCustomer::className(), 'targetAttribute' => ['id_customer' => 'id']],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => TStatusOrder::className(), 'targetAttribute' => ['id_status' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => TPembayaran::className(), 'targetAttribute' => ['id' => 'id_booking']],
        ];
    }


public function generateBookingNumber($attribute, $length = 3){           
   $kodeBooking = "IT".Yii::$app->getSecurity()->generateRandomString($length);
    $uptoken = strtoupper($kodeBooking);

    if(!$this->findOne([$attribute =>$uptoken])){
        return $uptoken;
    }else{
        return $this->generateUniqueRandomString($attribute, $length);
    }
            
}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode Booking',
            'id_destinasi' => 'Name Of Trip',
            'id_customer' => 'Leader',
            'tgl_trip' => 'Date Of Trip',
            'waktu_booking' => 'Booking Time',
            'waktu_exp' => 'Exp Time',
            'total_pax' => 'Total Pax',
            'biaya_trip' => 'Biaya Trip',
            'biaya_jemput' => 'Biaya Jemput',
            'biaya_antar' => 'Biaya Antar',
            'total_biaya' => 'Total Keseluruhan',
            'id_status' => 'Status',
            'total_ajem'=>'Biaya Pickup & Drop Off',
            'timestamp' => 'Timestamp',
            'id_pembayaran'=>'Pembayaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAntars()
    {
        return $this->hasMany(TAntar::className(), ['id_booking' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCustomer()
    {
        return $this->hasOne(TCustomer::className(), ['id' => 'id_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDestinasi()
    {
        return $this->hasOne(TDestinasi::className(), ['id' => 'id_destinasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(TStatusOrder::className(), ['id' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTJemputs()
    {
        return $this->hasMany(TJemput::className(), ['id_booking' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPembayaran()
    {
        return $this->hasOne(TPembayaran::className(), ['id_booking' => 'id']);
    }
   
}
