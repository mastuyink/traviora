<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_extra_data".
 *
 * @property integer $id
 * @property string $nama
 * @property string $content
 */
class TExtraData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_extra_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'content'], 'required'],
            [['content'], 'string'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama' => Yii::t('app', 'Nama'),
            'content' => Yii::t('app', 'Content'),
        ];
    }
}
