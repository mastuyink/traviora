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
    public $pax_request;

   

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
            [['biaya_trip', 'biaya_jemput', 'biaya_antar', 'total_biaya'], 'number'],
            [['id_destinasi', 'id_customer', 'total_pax', 'id_status','dewasa','anak','bayi'], 'integer'],
            [['tgl_trip', 'waktu_booking', 'waktu_exp', 'timestamp'], 'safe'],
            [['id'], 'string', 'max' => 5],
            ['pax_request','cekStok'],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => TCustomer::className(), 'targetAttribute' => ['id_customer' => 'id']],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => TStatusOrder::className(), 'targetAttribute' => ['id_status' => 'id']],
        ];
    }

public function cekStok($attribute, $id_dest){
    $Dest = TDestinasi::findOne($id_dest);
    $stok = $Dest->stok_seat;
    if ($this->$attribute > $stok) {
        $this->addError($attribute,'The number of seats is not enough ');
        return false;
    }else{
        return true;
    }
}

public function generateBookingNumber($attribute, $length = 4){
    $pool = array_merge(range(0,9),range('A', 'Z')); 
    for($i=0; $i < $length; $i++) {
        $key[] = $pool[mt_rand(0, count($pool) - 1)];
    }          
     $kodeBooking = "B".join($key);
    if(!$this->findOne([$attribute =>$kodeBooking])){
        return $kodeBooking;
    }else{
        return $this->generateBookingNumber($attribute, $length);
    }
            
}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'Nomor order',
            'id_destinasi'  => 'Destination',
            'id_customer'   => 'Customer / Leader',
            'tgl_trip'      => 'Date Of Trip',
            'waktu_booking' => 'Booking Time',
            'waktu_exp'     => 'Exp Time',
            'total_pax'     => 'Total Pax',
            'biaya_trip'    => 'Trip Price',
            'biaya_jemput'  => 'Pickup Price',
            'biaya_antar'   => 'Drop Off Price',
            'total_biaya'   => 'Grand Total',
            'id_status'     => 'Status',
            'total_ajem'    => 'Pickup & Drop Off Cost',
            'dewasa'        => 'Adult',
            'anak'          => 'Child',
            'bayi'          => 'Infant',
            'timestamp'     => 'Timestamp',
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
