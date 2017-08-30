<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_post".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $judul_content
 * @property string $content
 * @property integer $id_author
 * @property string $create_at
 * @property string $last_update
 *
 * @property User $idAuthor
 * @property TDestinasi $idDestinasi
 */
class TPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_destinasi', 'judul_content', 'content', 'id_author'], 'required'],
            [['id_destinasi', 'id_author'], 'integer'],
            [['judul_content', 'content'], 'string'],
            [['create_at', 'last_update'], 'safe'],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_author' => 'id']],
            [['id_destinasi'], 'exist', 'skipOnError' => true, 'targetClass' => TDestinasi::className(), 'targetAttribute' => ['id_destinasi' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_destinasi' => 'Id Destinasi',
            'judul_content' => 'Judul Content',
            'content' => 'Content',
            'id_author' => 'Id Author',
            'create_at' => 'Create At',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
