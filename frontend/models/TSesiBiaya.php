<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_sesi_biaya".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property integer $id_jenis_sesi
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 * @property integer $id_biaya
 * @property string $datetime
 *
 * @property TBiaya $idBiaya
 * @property TDestinasi $idDestinasi
 * @property TJenisSesi $idJenisSesi
 */
class TSesiBiaya extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_sesi_biaya';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'id_jenis_sesi', 'tgl_mulai', 'tgl_selesai', 'id_biaya'], 'required'],
            [['id_destinasi', 'id_jenis_sesi', 'id_biaya'], 'integer'],
            [['tgl_mulai', 'tgl_selesai', 'datetime'], 'safe'],
            [['id_biaya'], 'exist', 'skipOnError' => true, 'targetClass' => TBiaya::className(), 'targetAttribute' => ['id_biaya' => 'id']],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_jenis_sesi'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisSesi::className(), 'targetAttribute' => ['id_jenis_sesi' => 'id']],
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
            'id_jenis_sesi' => Yii::t('app', 'Id Jenis Sesi'),
            'tgl_mulai' => Yii::t('app', 'Tgl Mulai'),
            'tgl_selesai' => Yii::t('app', 'Tgl Selesai'),
            'id_biaya' => Yii::t('app', 'Id Biaya'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBiaya()
    {
        return $this->hasOne(TBiaya::className(), ['id' => 'id_biaya']);
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
    public function getIdJenisSesi()
    {
        return $this->hasOne(TJenisSesi::className(), ['id' => 'id_jenis_sesi']);
    }
}
