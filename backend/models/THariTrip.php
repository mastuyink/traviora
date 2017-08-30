<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_hari_trip".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property integer $id_jenis_hari_trip
 * @property integer $id_senin
 * @property integer $id_selasa
 * @property integer $id_rabu
 * @property integer $id_kamis
 * @property integer $id_jumat
 * @property integer $id_sabtu
 * @property integer $id_minggu
 * @property string $datetime
 *
 * @property TDestinasi $idDestinasi
 * @property TJenisHariTrip $idJenisHariTrip
 * @property TKodeHari $idJumat
 * @property TKodeHari $idKamis
 * @property TKodeHari $idMinggu
 * @property TKodeHari $idRabu
 * @property TKodeHari $idSabtu
 * @property TKodeHari $idSelasa
 * @property TKodeHari $idSenin
 */
class THariTrip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_hari_trip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'id_jenis_hari_trip'], 'required'],
            [['id_destinasi', 'id_jenis_hari_trip', 'id_senin', 'id_selasa', 'id_rabu', 'id_kamis', 'id_jumat', 'id_sabtu', 'id_minggu'], 'integer'],
            [['datetime'], 'safe'],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_jenis_hari_trip'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisHariTrip::className(), 'targetAttribute' => ['id_jenis_hari_trip' => 'id']],
            /*[['id_jumat'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_jumat' => 'id']],
            [['id_kamis'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_kamis' => 'id']],
            [['id_minggu'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_minggu' => 'id']],
            [['id_rabu'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_rabu' => 'id']],
            [['id_sabtu'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_sabtu' => 'id']],
            [['id_selasa'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_selasa' => 'id']],
            [['id_senin'], 'exist', 'skipOnError' => true, 'targetClass' => TKodeHari::className(), 'targetAttribute' => ['id_senin' => 'id']],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_destinasi' => Yii::t('app', 'Id Destinasi'),
            'id_jenis_hari_trip' => Yii::t('app', 'Jenis Keberangkatan'),
            'id_senin' => Yii::t('app', ' Senin'),
            'id_selasa' => Yii::t('app', ' Selasa'),
            'id_rabu' => Yii::t('app', ' Rabu'),
            'id_kamis' => Yii::t('app', ' Kamis'),
            'id_jumat' => Yii::t('app', ' Jumat'),
            'id_sabtu' => Yii::t('app', ' Sabtu'),
            'id_minggu' => Yii::t('app', ' Minggu'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
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
    public function getIdJenisHariTrip()
    {
        return $this->hasOne(TJenisHariTrip::className(), ['id' => 'id_jenis_hari_trip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJumat()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_jumat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKamis()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_kamis']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMinggu()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_minggu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRabu()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_rabu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSabtu()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_sabtu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSelasa()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_selasa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSenin()
    {
        return $this->hasOne(TKodeHari::className(), ['id' => 'id_senin']);
    }
}
