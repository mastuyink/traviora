<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_kurs".
 *
 * @property string $id
 * @property integer $real_kurs
 * @property integer $round_kurs
 * @property string $update_at
 */
class TKurs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_kurs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'round_kurs'], 'required'],
            [[ 'round_kurs'], 'integer'],
            [['update_at'], 'safe'],
            [['id'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
           
            'round_kurs' => 'Round Kurs',
            'update_at' => 'Update At',
        ];
    }
}
