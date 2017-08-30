<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jenis_sesi".
 *
 * @property integer $id
 * @property string $jenis_sesi
 *
 * @property TSesiBiaya[] $tSesiBiayas
 */
class TJenisSesi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenis_sesi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_sesi'], 'required'],
            [['jenis_sesi'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jenis_sesi' => Yii::t('app', 'Jenis Sesi'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSesiBiayas()
    {
        return $this->hasMany(TSesiBiaya::className(), ['id_jenis_sesi' => 'id']);
    }
}
