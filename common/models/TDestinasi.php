<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_destinasi".
 *
 * @property integer $id
 * @property integer $id_jenis_destinasi
 * @property string $nama_destinasi
 * @property integer $min_pax
 * @property integer $max_pax
 * @property integer $jatah_seat
 * @property integer $stok_seat
 * @property integer $seat_terjual
 * @property integer $main_limit
 * @property integer $id_status
 * @property string $create_at
 * @property string $timestamp
 *
 * @property TBiayaKhusus[] $tBiayaKhususes
 * @property TBooking[] $tBookings
 * @property TStatusDestinasi $idStatus
 * @property TJenisDestinasi $idJenisDestinasi
 * @property THariTrip $tHariTrip
 * @property TLiburTrip[] $tLiburTrips
 * @property TLimitDestinasi[] $tLimitDestinasis
 * @property TPost[] $tPosts
 * @property TSesiBiaya[] $tSesiBiayas
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
            [['id_jenis_destinasi', 'nama_destinasi', 'min_pax', 'max_pax', 'jatah_seat', 'main_limit'], 'required'],
            [['id_jenis_destinasi', 'min_pax', 'max_pax', 'jatah_seat', 'stok_seat', 'seat_terjual', 'main_limit', 'id_status'], 'integer'],
            [['create_at', 'timestamp'], 'safe'],
            [['nama_destinasi'], 'string', 'max' => 50],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => TStatusDestinasi::className(), 'targetAttribute' => ['id_status' => 'id']],
            [['id_jenis_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisDestinasi::className(), 'targetAttribute' => ['id_jenis_destinasi' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_jenis_destinasi' => Yii::t('app', 'Id Jenis Destinasi'),
            'nama_destinasi' => Yii::t('app', 'Nama Destinasi'),
            'min_pax' => Yii::t('app', 'Min Pax'),
            'max_pax' => Yii::t('app', 'Max Pax'),
            'jatah_seat' => Yii::t('app', 'Jatah Seat'),
            'stok_seat' => Yii::t('app', 'Stok Seat'),
            'seat_terjual' => Yii::t('app', 'Seat Terjual'),
            'main_limit' => Yii::t('app', 'Main Limit'),
            'id_status' => Yii::t('app', 'Id Status'),
            'create_at' => Yii::t('app', 'Create At'),
            'timestamp' => Yii::t('app', 'Timestamp'),
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
    public function getIdStatus()
    {
        return $this->hasOne(TStatusDestinasi::className(), ['id' => 'id_status']);
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
}
