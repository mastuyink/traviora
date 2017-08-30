<?php

namespace app\models;

use Yii;
use common\models\User;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
/**
 * This is the model class for table "t_post".
 *
 * @property integer $id
 * @property integer $id_destinasi
 * @property string $gbr_thumbnail
 * @property string $judul_content
 * @property string $content
 * @property integer $id_author
 * @property string $create_at
 * @property string $last_update
 *
 * @property User $idAuthor
 * @property TDestinasi $idDestinasi
 */
class Posting extends \yii\db\ActiveRecord
{
    public $thumbnail;
    public $carrousel;
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
            [['id_destinasi', 'content', 'id_author'], 'required'],
            [['id_destinasi', 'id_author'], 'integer'],
            [['content'], 'string'],
            [['create_at', 'last_update'], 'safe'],
            [['gbr_thumbnail'],'string', 'max' => 256],
            [['slug_url'],'string', 'max' => 50],
            //s [['carrousel'], 'file','maxFiles' => 10,'extensions' => 'png, jpg, jpeg, gif', 'skipOnEmpty' => true],
           //[['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
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
            'id' => Yii::t('app', 'ID'),
            'id_destinasi' => Yii::t('app', 'Destinasi'),
            'gbr_thumbnail' => Yii::t('app', 'Gbr Thumbnail'),
            'slug_url'=>Yii::t('app', 'SlugUrl'),
            'content' => Yii::t('app', 'Content'),
            'id_author' => Yii::t('app', 'Author'),
            'create_at' => Yii::t('app', 'Create At'),
            'last_update' => Yii::t('app', 'Last Update'),
        ];
    }
    public function upload($id_dest)
    {
        if ($this->validate()) { 
            $path = Yii::$app->basePath.'/posting/'.$id_dest.'/';
                FileHelper::createDirectory($path, $mode = 0777, $recursive = true);
                $this->thumbnail->saveAs($path.$this->thumbnail->baseName.'.'.$this->thumbnail->extension);
                $this->gbr_thumbnail = $path.$this->thumbnail->baseName.'.'.$this->thumbnail->extension;
                $this->save();
                
            return true;
        } else {
            return false;
        }
    }

       public function Carnew($id_post,$id_dest)
    {
        if ($this->validate()) { 
             $path = Yii::$app->basePath.'/posting/'.$id_dest.'/carrousel/';
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


       
       public function Carup($id_post,$id_dest)
    {
        if ($this->validate()) { 
             $path = Yii::$app->basePath.'/posting/'.$id_dest.'/carrousel/';
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
