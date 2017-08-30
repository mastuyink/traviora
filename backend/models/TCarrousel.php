<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_carrousel".
 *
 * @property integer $id
 * @property integer $id_jenis_carrousel
 * @property string $name
 * @property string $filename
 * @property integer $size
 * @property string $type
 * @property integer $id_post
 * @property string $time
 *
 * @property TJenisCarrousel $idJenisCarrousel
 * @property TPost $idPost
 */
class TCarrousel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_carrousel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'size', 'id_post'], 'integer'],
            [['id_post'], 'required'],
            [['time'], 'safe'],
            [['name', 'filename'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 64],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => TPost::className(), 'targetAttribute' => ['id_post' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'filename' => Yii::t('app', 'Filename'),
            'size' => Yii::t('app', 'Size'),
            'type' => Yii::t('app', 'Type'),
            'id_post' => Yii::t('app', 'Id Post'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(TPost::className(), ['id' => 'id_post']);
    }
}
