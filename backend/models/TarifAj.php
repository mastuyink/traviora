<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_tarif_aj".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property integer $id_lokasi
 * @property integer $id_area
 * @property integer $id_jenis_tarif

 * @property integer $tarif_pax
 * @property integer $tarif_car
 * @property string $datetime
 *
 * @property AreaAj $idArea
 * @property TDestinasi $idDestinasi
 * @property JenisTarifAj $idJenisTarif
 * @property TLokasiAj $idLokasi

 */
class TarifAj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_tarif_aj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'id_lokasi', 'id_area', 'id_jenis_tarif'], 'required'],
            [['id_destinasi', 'id_lokasi', 'id_area', 'id_jenis_tarif',  'tarif_pax', 'tarif_car','tarif_elf'], 'integer'],
            [['datetime'], 'safe'],
           // ['tarif_pax','cekInput'],
           // ['tarif_pax','cekInput'],
            [['id_area'], 'exist', 'skipOnError' => true, 'targetClass' => AreaAj::className(), 'targetAttribute' => ['id_area' => 'id']],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_jenis_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => JenisTarifAj::className(), 'targetAttribute' => ['id_jenis_tarif' => 'id']],
            [['id_lokasi'], 'exist', 'skipOnError' => true, 'targetClass' => TLokasiAj::className(), 'targetAttribute' => ['id_lokasi' => 'id']],
            
        ];
    }
/*
    public function cekInput($attribute){

    if ($this->tarif_pax == null  && $this->tarif_car == null) {
        $this->addError($attribute,'Harus Di Isi');
        $this->addError($attribute,'Harus Di Isi');
        return false;
    }elseif ($this->tarif_pax == null  && $this->tarif_car !== null) {
        return true;
    }elseif ($this->tarif_pax !== null  && $this->tarif_car == null) {
        return true;
    }else{
        return true;   
    }
}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_destinasi' => Yii::t('app', 'Id Destinasi'),
            'id_lokasi' => Yii::t('app', 'Id Lokasi'),
            'id_area' => Yii::t('app', 'Id Area'),
            'id_jenis_tarif' => Yii::t('app', 'Id Jenis Tarif'),
            'tarif_pax' => Yii::t('app', 'Tarif Pax'),
            'tarif_car' => Yii::t('app', 'Tarif Avanza / APV'),
            'tarif_elf'=> Yii::t('app', 'Tarif Elf'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdArea()
    {
        return $this->hasOne(AreaAj::className(), ['id' => 'id_area']);
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
    public function getIdJenisTarif()
    {
        return $this->hasOne(JenisTarifAj::className(), ['id' => 'id_jenis_tarif']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLokasi()
    {
        return $this->hasOne(TLokasiAj::className(), ['id' => 'id_lokasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   
}
