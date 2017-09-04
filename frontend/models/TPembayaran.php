<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_pembayaran".
 *
 * @property integer $id
 * @property string $id_booking
 * @property integer $id_metode
 * @property string $nama_pengirim
 * @property string $tgl_kirim
 * @property integer $jumlah_kirim
 * @property string $token_konfirmasi
 * @property string $datetime
 *
 * @property TBooking $idBooking
 * @property TMetodePembayaran $idMetode
 */
class TPembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_booking','token_konfirmasi'], 'required'],
            [['id_metode', 'jumlah_kirim'], 'integer'],
            [['tgl_kirim', 'datetime'], 'safe'],
            [['id_booking','currency'], 'string', 'max' => 5],
            [['nama_pengirim'], 'string', 'max' => 50],
            [['token_konfirmasi'], 'string', 'max' => 25],
            [['token_konfirmasi'], 'unique'],
            [['id_booking'], 'exist', 'skipOnError' => true, 'targetClass' => TBooking::className(), 'targetAttribute' => ['id_booking' => 'id']],
            [['id_metode'], 'exist', 'skipOnError' => true, 'targetClass' => TMetodePembayaran::className(), 'targetAttribute' => ['id_metode' => 'id']],
            [['currency'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\TKurs::className(), 'targetAttribute' => ['currency' => 'id']],
        ];
    }

public function generatePaymentToken($attribute, $length = 25){           
   $kodeBooking = Yii::$app->getSecurity()->generateRandomString($length);
   // $uptoken = strtoupper($kodeBooking);

    if(!$this->findOne([$attribute =>$kodeBooking])){
        return $kodeBooking;
    }else{
        return $this->generatePaymentToken($attribute, $length);
    }
            
}
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_booking' => 'No Booking',
            'id_metode' => 'Payment Method',
            'nama_pengirim' => 'Sender Name',
            'tgl_kirim' => 'Transfer date',
            'jumlah_kirim' => 'Total Transfer',
            'token_konfirmasi' => 'Confirm Token',
            'currency'=>'Currency',
            'datetime' => 'Datetime',
        ];
    }



    public function getCurrency()
    {
        return $this->hasOne(\common\models\TKurs::className(), ['id' => 'currency']);
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
    public function getIdMetode()
    {
        return $this->hasOne(TMetodePembayaran::className(), ['id' => 'id_metode']);
    }
}
