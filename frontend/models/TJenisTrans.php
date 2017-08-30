<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jenis_trans".
 *
 * @property integer $id
 * @property string $jenis_transport
 * @property integer $pass_max
 * @property integer $pass_min
 * @property string $last_edit
 *
 * @property TTransport[] $tTransports
 */
class TJenisTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenis_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_transport', 'pass_max', 'pass_min'], 'required'],
            [['pass_max', 'pass_min'], 'integer'],
            [['last_edit'], 'safe'],
            [['jenis_transport'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_transport' => 'Jenis Transport',
            'pass_max' => 'Pass Max',
            'pass_min' => 'Pass Min',
            'last_edit' => 'Last Edit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTransports()
    {
        return $this->hasMany(TTransport::className(), ['id_jenis_trans' => 'id']);
    }
}
