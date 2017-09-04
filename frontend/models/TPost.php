<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "t_post".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $slug
 * @property string $gbr_thumbnail
 * @property string $content
 * @property integer $id_author
 * @property string $create_at
 * @property string $last_update
 *
 * @property TCarrousel[] $tCarrousels
 * @property User $idAuthor
 * @property TDestinasi $idDestinasi
 */
class TPost extends \yii\db\ActiveRecord
{
    public $carrousel;
    public $thumbnail;
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
            [['id_destinasi', 'content', 'id_author','slug','description'], 'required'],
            [['id_destinasi', 'id_author'], 'integer'],
            [['content'], 'string'],
            [['slug','description'], 'unique'],
            [['create_at', 'last_update'], 'safe'],
            [['slug','keywords'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 110],
            [['gbr_thumbnail'], 'string', 'max' => 255],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['id_author' => 'id']],
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
            'id_destinasi' => 'Name Of Trip',
            'slug' => 'Slug',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'gbr_thumbnail' => 'Gbr Thumbnail',
            'content' => 'Content',
            'id_author' => 'Id Author',
            'create_at' => 'Create At',
            'last_update' => 'Last Update',

        ];
    }


        public function upload($slug)
    {
        if ($this->validate()) { 
            $path = Yii::$app->basePath.'/posting/'.$slug.'/';
                FileHelper::createDirectory($path, $mode = 0777, $recursive = true);
                $this->thumbnail->saveAs($path.$this->thumbnail->baseName.'.'.$this->thumbnail->extension);
                $this->gbr_thumbnail = $path.$this->thumbnail->baseName.'.'.$this->thumbnail->extension;
                $this->save();
                
            return true;
        } else {
            return false;
        }
    }

       public function Carnew($id_post,$slug)
    {
        if ($this->validate()) { 
             $path = Yii::$app->basePath.'/posting/'.$slug.'/carrousel/';
                FileHelper::createDirectory($path, $mode = 0777, $recursive = true);

            foreach ($this->carrousel as $filex) {

                $filex->saveAs($path.$filex->baseName.'.'.$filex->extension);
                $modelcar = new TCarrousel();
                $modelcar->name = $filex->name;
                $modelcar->filename = $path.$filex->baseName.'.'.$filex->extension;
                $modelcar->size = $filex->size;
                $modelcar->type = "image/".$filex->extension;
                $modelcar->id_post= $id_post;
                $modelcar->save();
                
            }
            return true;
        } else {
            return false;
        }
    }


       
       public function Carup($id_post,$slug)
    {
        if ($this->validate()) { 
             $path = Yii::$app->basePath.'/posting/'.$slug.'/carrousel/';
                FileHelper::createDirectory($path, $mode = 0777, $recursive = true);

            foreach ($this->carrousel as $filex) {
                 $filex->saveAs($path.$filex->baseName.'.'.$filex->extension);
                
                $modelcar = TCarrousel::find()->where(['name'=>$filex->name])->andWhere(['filename'=>$path.$filex->baseName.'.'.$filex->extension])->andWhere(['id_post'=>$id_post])->one();
            if ($modelcar !== null) {
                $modelcar->name     = $filex->name;
                $modelcar->filename = $path.$filex->baseName.'.'.$filex->extension;
                $modelcar->size     = $filex->size;
                $modelcar->type     = "image/".$filex->extension;
                $modelcar->id_post  = $id_post;
                $modelcar->save();
            }else{
                $modelcarn = new TCarrousel();
                $modelcarn->name     = $filex->name;
                $modelcarn->filename = $path.$filex->baseName.'.'.$filex->extension;
                $modelcarn->size     = $filex->size;
                $modelcarn->type     = "image/".$filex->extension;
                $modelcarn->id_post  = $id_post;
                $modelcarn->save();
                
            }
                
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCarrousels()
    {
        return $this->hasMany(TCarrousel::className(), ['id_post' => 'id']);
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
