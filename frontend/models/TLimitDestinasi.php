<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_limit_destinasi".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $event_limit
 * @property string $tgl_limit
 * @property integer $jumlah_limit
 * @property string $datetime
 *
 * @property TDestinasi $idDestinasi
 */
class TLimitDestinasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_limit_destinasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'event_limit', 'tgl_limit', 'jumlah_limit'], 'required'],
            [['id_destinasi', 'jumlah_limit'], 'integer'],
            [['tgl_limit', 'datetime'], 'safe'],
            [['event_limit'], 'string', 'max' => 50],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
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
            'event_limit' => Yii::t('app', 'Event Limit'),
            'tgl_limit' => Yii::t('app', 'Tgl Limit'),
            'jumlah_limit' => Yii::t('app', 'Jumlah Limit'),
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
}
