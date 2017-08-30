<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jenis_kofirmasi".
 *
 * @property integer $id
 * @property string $jenis_konfirmasi
 *
 * @property TDestinasi[] $tDestinasis
 */
class TJenisKofirmasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenis_kofirmasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_konfirmasi'], 'required'],
            [['jenis_konfirmasi'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jenis_konfirmasi' => Yii::t('app', 'Jenis Konfirmasi'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDestinasis()
    {
        return $this->hasMany(TDestinasi::className(), ['id_jenis_konfirmasi' => 'id']);
    }
}
