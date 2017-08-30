<?php

namespace app\models;

use Yii;
//use backend\models\TDestinasi;

/**
 * This is the model class for table "t_libur_trip".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $tgl_libur
 * @property string $datetime
 *
 * @property TDestinasi $idDestinasi
 */
class TLiburTrip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_libur_trip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'tgl_libur'], 'required'],
            [['id_destinasi'], 'integer'],
            [['tgl_libur', 'datetime'], 'safe'],
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
            'id_destinasi' => Yii::t('app', 'Destinasi'),
            'tgl_libur' => Yii::t('app', 'Tgl Libur'),
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
