<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_status_destinasi".
 *
 * @property integer $id
 * @property string $status
 *
 * @property TDestinasi[] $tDestinasis
 */
class TStatusDestinasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_status_destinasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDestinasis()
    {
        return $this->hasMany(TDestinasi::className(), ['id_status' => 'id']);
    }
}
