<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_lokasi_destinasi".
 *
 * @property integer $id
 * @property string $lokasi
 * @property string $datetime
 *
 * @property TDestinasi[] $tDestinasis
 */
class LokasiDestinasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_lokasi_destinasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lokasi'], 'required'],
            [['datetime'], 'safe'],
            [['lokasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lokasi' => Yii::t('app', 'Lokasi'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDestinasis()
    {
        return $this->hasMany(TDestinasi::className(), ['id_lokasi_destinasi' => 'id']);
    }
}
