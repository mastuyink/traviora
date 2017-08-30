<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jk".
 *
 * @property integer $id
 * @property string $jenis_kelamin
 *
 * @property TCustomer[] $tCustomers
 */
class TJk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_kelamin'], 'required'],
            [['jenis_kelamin'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_kelamin' => 'Jenis Kelamin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCustomers()
    {
        return $this->hasMany(TCustomer::className(), ['id_jk' => 'id']);
    }
}
