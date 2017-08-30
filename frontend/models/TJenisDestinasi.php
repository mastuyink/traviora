<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jenis_destinasi".
 *
 * @property integer $id
 * @property string $jenis_destinasi
 *
 * @property TDestinasi[] $tDestinasis
 */
class TJenisDestinasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenis_destinasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_destinasi'], 'required'],
            [['jenis_destinasi'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_destinasi' => 'Jenis Destinasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDestinasis()
    {
        return $this->hasMany(TDestinasi::className(), ['id_jenis_destinasi' => 'id']);
    }
}
