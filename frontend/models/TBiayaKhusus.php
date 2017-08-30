<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_biaya_khusus".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $event
 * @property string $tgl_event
 * @property integer $id_biaya
 * @property string $datetime
 *
 * @property TDestinasi $idDestinasi
 * @property TBiaya $idBiaya
 */
class TBiayaKhusus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_biaya_khusus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'event', 'tgl_event', 'id_biaya'], 'required'],
            [['id_destinasi', 'id_biaya'], 'integer'],
            [['tgl_event', 'datetime'], 'safe'],
            [['event'], 'string', 'max' => 50],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
            [['id_biaya'], 'exist', 'skipOnError' => true, 'targetClass' => TBiaya::className(), 'targetAttribute' => ['id_biaya' => 'id']],
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
            'event' => Yii::t('app', 'Event'),
            'tgl_event' => Yii::t('app', 'Tgl Event'),
            'id_biaya' => Yii::t('app', 'Id Biaya'),
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
    public function getIdBiaya()
    {
        return $this->hasOne(TBiaya::className(), ['id' => 'id_biaya']);
    }
}
