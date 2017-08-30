<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_waktu_jemput".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property integer $id_lokasi_aj
 * @property string $start_time
 * @property string $end_time
 * @property string $datetime
 *
 * @property TDestinasi $idDestinasi
 * @property TLokasiAj $idLokasiAj
 */
class WaktuJemput extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_waktu_jemput';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'id_lokasi_aj', 'start_time', 'end_time'], 'required'],
            [['id_destinasi', 'id_lokasi_aj'], 'integer'],
            [['start_time', 'end_time', 'datetime'], 'safe'],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_lokasi_aj'], 'exist', 'skipOnError' => true, 'targetClass' => TLokasiAj::className(), 'targetAttribute' => ['id_lokasi_aj' => 'id']],
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
            'id_lokasi_aj' => Yii::t('app', 'Id Lokasi Aj'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
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
    public function getIdLokasiAj()
    {
        return $this->hasOne(TLokasiAj::className(), ['id' => 'id_lokasi_aj']);
    }
}
