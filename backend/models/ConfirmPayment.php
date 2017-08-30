<?php

namespace app\models;

use Yii;
use yii\base\Model;
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
class ConfirmPayment extends \yii\db\ActiveRecord
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
            [['nama_pengirim','jumlah_kirim','tgl_kirim'], 'required', 'message' => '{attribute} Harus Di Isi'],
            [[ 'jumlah_kirim'], 'integer'],
            [['tgl_kirim', 'datetime'], 'safe'],
            [['token_konfirmasi'], 'string', 'max' => 25],
            [['token_konfirmasi'], 'unique'],
            [['id_booking'],'string'],
            [['id_booking'], 'exist', 'skipOnError' => true, 'targetClass' => TBooking::className(), 'targetAttribute' => ['id_booking' => 'id']],
          
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_booking' => 'Nomor Order',
            'id_metode' => 'Metode Transfer',
            'nama_pengirim' => 'Nama Pengirim',
            'tgl_kirim' => 'Tanggal Kirim',
            'jumlah_kirim' => 'Jumlah Kirim',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBooking()
    {
        return $this->hasOne(TBooking::className(), ['id' => 'id_booking']);
    }

  
}
