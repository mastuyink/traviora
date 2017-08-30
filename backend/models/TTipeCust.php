<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_tipe_cust".
 *
 * @property integer $id
 * @property string $tipe_cust
 *
 * @property TCustomer[] $tCustomers
 */
class TTipeCust extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_tipe_cust';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipe_cust'], 'required'],
            [['tipe_cust'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipe_cust' => 'Tipe Cust',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCustomers()
    {
        return $this->hasMany(TCustomer::className(), ['id_tipe_cust' => 'id']);
    }
}
