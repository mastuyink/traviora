<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_status_order".
 *
 * @property integer $id
 * @property string $status
 * @property string $last_edit
 *
 * @property TBooking[] $tBookings
 */
class TStatusOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_status_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'required'],
            [['id'], 'integer'],
            [['last_edit'], 'safe'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'last_edit' => 'Last Edit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBookings()
    {
        return $this->hasMany(TBooking::className(), ['id_status' => 'id']);
    }
}
