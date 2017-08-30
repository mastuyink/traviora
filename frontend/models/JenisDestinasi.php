<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "v_jenis_destinasi".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $gbr_thumbnail
 * @property string $judul_content
 * @property string $content
 * @property integer $id_author
 * @property string $create_at
 * @property string $last_update
 * @property integer $id_jenis_destinasi
 */
class JenisDestinasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_jenis_destinasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_destinasi', 'id_author', 'id_jenis_destinasi'], 'integer'],
            [['id_destinasi', 'judul_content', 'content', 'id_author', 'id_jenis_destinasi'], 'required'],
            [['judul_content', 'content'], 'string'],
            [['create_at', 'last_update'], 'safe'],
            [['gbr_thumbnail'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_destinasi' => Yii::t('app', 'Id Destinasi'),
            'gbr_thumbnail' => Yii::t('app', 'Gbr Thumbnail'),
            'judul_content' => Yii::t('app', 'Judul Content'),
            'content' => Yii::t('app', 'Content'),
            'id_author' => Yii::t('app', 'Id Author'),
            'create_at' => Yii::t('app', 'Create At'),
            'last_update' => Yii::t('app', 'Last Update'),
            'id_jenis_destinasi' => Yii::t('app', 'Id Jenis Destinasi'),
        ];
    }

     public function getIdAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDestinasi()
    {
        return $this->hasOne(TDestinasi::className(), ['id' => 'id_destinasi']);
    }
}
