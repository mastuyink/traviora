<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_destinasi".
 *
 * @property integer $id
 * @property integer $id_supplier
 * @property integer $id_lokasi_destinasi
 * @property integer $id_jenis_destinasi
 * @property string $nama_destinasi
 * @property integer $min_pax
 * @property integer $max_pax
 * @property integer $jatah_seat
 * @property integer $stok_seat
 * @property integer $seat_terjual
 * @property integer $main_limit
 * @property integer $id_status
 * @property integer $id_jenis_konfirmasi
 * @property string $create_at
 * @property string $timestamp
 *
 * @property TBiayaKhusus[] $tBiayaKhususes
 * @property TBooking[] $tBookings
 * @property TJenisKofirmasi $idJenisKonfirmasi
 * @property LokasiDestinasi $idLokasiDestinasi
 * @property TStatusDestinasi $idStatus
 * @property TSupplier $idSupplier
 * @property TJenisDestinasi $idJenisDestinasi
 * @property THariTrip $tHariTrip
 * @property TLiburTrip[] $tLiburTrips
 * @property TLimitDestinasi[] $tLimitDestinasis
 * @property TPost[] $tPosts
 * @property TSesiBiaya[] $tSesiBiayas
 * @property TTarifAj[] $tTarifAjs
 * @property TWaktuJemput[] $tWaktuJemputs
 */
class TDestinasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_destinasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_supplier', 'id_lokasi_destinasi', 'id_jenis_destinasi', 'nama_destinasi', 'min_pax', 'max_pax', 'jatah_seat', 'main_limit'], 'required'],
            [['id_supplier', 'id_lokasi_destinasi', 'id_jenis_destinasi', 'min_pax', 'max_pax', 'jatah_seat', 'stok_seat', 'seat_terjual', 'main_limit', 'id_status', 'id_jenis_konfirmasi'], 'integer'],
            [['create_at', 'timestamp'], 'safe'],
            [['nama_destinasi'], 'string', 'max' => 50],
            [['id_jenis_konfirmasi'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisKofirmasi::className(), 'targetAttribute' => ['id_jenis_konfirmasi' => 'id']],
            [['id_lokasi_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => LokasiDestinasi::className(), 'targetAttribute' => ['id_lokasi_destinasi' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => TStatusDestinasi::className(), 'targetAttribute' => ['id_status' => 'id']],
            [['id_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => TSupplier::className(), 'targetAttribute' => ['id_supplier' => 'id']],
            [['id_jenis_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisDestinasi::className(), 'targetAttribute' => ['id_jenis_destinasi' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_supplier' => 'Supplier',
            'id_lokasi_destinasi' => 'Lokasi Trip',
            'id_jenis_destinasi' => 'Jenis Trip',
            'nama_destinasi' => 'Name Of Trip',
            'min_pax' => 'Min Pax',
            'max_pax' => 'Max Pax',
            'jatah_seat' => 'Jatah Seat',
            'stok_seat' => 'Stok Seat',
            'seat_terjual' => 'Seat Terjual',
            'main_limit' => 'Main Limit',
            'id_status' => 'Status',
            'id_jenis_konfirmasi' => 'Jenis Konfirmasi',
            'create_at' => 'Create At',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBiayaKhususes()
    {
        return $this->hasMany(TBiayaKhusus::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBookings()
    {
        return $this->hasMany(TBooking::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisKonfirmasi()
    {
        return $this->hasOne(TJenisKofirmasi::className(), ['id' => 'id_jenis_konfirmasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLokasiDestinasi()
    {
        return $this->hasOne(LokasiDestinasi::className(), ['id' => 'id_lokasi_destinasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(TStatusDestinasi::className(), ['id' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSupplier()
    {
        return $this->hasOne(TSupplier::className(), ['id' => 'id_supplier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisDestinasi()
    {
        return $this->hasOne(TJenisDestinasi::className(), ['id' => 'id_jenis_destinasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHariTrip()
    {
        return $this->hasOne(THariTrip::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTLiburTrips()
    {
        return $this->hasMany(TLiburTrip::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTLimitDestinasis()
    {
        return $this->hasMany(TLimitDestinasi::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPosts()
    {
        return $this->hasMany(TPost::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSesiBiayas()
    {
        return $this->hasMany(TSesiBiaya::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTarifAjs()
    {
        return $this->hasMany(TTarifAj::className(), ['id_destinasi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTWaktuJemputs()
    {
        return $this->hasMany(TWaktuJemput::className(), ['id_destinasi' => 'id']);
    }
}
