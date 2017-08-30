<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_validasi_pembayaran".
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
 * @property string $waktu_konfirmasi
 * @property integer $id_metode
 * @property string $nama_pengirim
 * @property string $tgl_kirim
 * @property integer $jumlah_kirim
 * @property string $datetime
 */
class VValidasiPembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_validasi_pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'tgl_trip', 'total_pax', 'biaya_trip', 'total_biaya', 'id_metode'], 'required'],
            [['id_destinasi', 'id_customer', 'total_pax', 'biaya_trip', 'biaya_jemput', 'biaya_antar', 'total_biaya', 'id_status', 'id_metode', 'jumlah_kirim'], 'integer'],
            [['tgl_trip', 'waktu_booking', 'waktu_exp', 'waktu_konfirmasi', 'tgl_kirim', 'datetime'], 'safe'],
            [['id'], 'string', 'max' => 5],
            [['nama_pengirim'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Kode Booking',

            'id_destinasi' => 'Destinasi',
            'id_customer' => 'Leader',
            'tgl_trip' => 'Tgl Trip',
            'waktu_booking' => 'Book Time',
            'waktu_exp' => 'Exp Time',
            'total_pax' => 'Pax',
            'biaya_trip' => 'Trip Price',
            'biaya_jemput' => 'Jemput Price',
            'biaya_antar' => 'Antar Price',
            'total_biaya' => 'Total Price',
            'id_status' => 'Status',
            'waktu_konfirmasi' => 'Conf Time',
            'id_metode' => 'Metode',
            'nama_pengirim' => 'Sender',
            'tgl_kirim' => 'Tgl Kirim',
            'jumlah_kirim' => 'Jumlah Kirim',
            'datetime' => 'Datetime',
        ];
    }

     public function getIdCustomer()
    {
        return $this->hasOne(TCustomer::className(), ['id' => 'id_customer']);
    }

    public function getIdBooking()
    {
        return $this->hasOne(TBooking::className(), ['id' => 'id']);
    }

    public function getIdPembayaran()
    {
        return $this->hasOne(TPembayaran::className(), ['id_booking' => 'id']);
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
}
