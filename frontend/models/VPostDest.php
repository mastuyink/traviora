<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_post_dest".
 *
 * @property integer $id
 * @property string $nama_destinasi
 * @property integer $id_destinasi
 */
class VPostDest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_post_dest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi'], 'integer'],
            [['nama_destinasi'], 'required'],
            [['nama_destinasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_destinasi' => 'Nama Destinasi',
            'id_destinasi' => 'Id Destinasi',
        ];
    }
}
