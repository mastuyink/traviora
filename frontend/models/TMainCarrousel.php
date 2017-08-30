<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
/**
 * This is the model class for table "t_main_carrousel".
 *
 * @property integer $id
 * @property string $path
 * @property integer $size
 * @property string $time
 */
class TMainCarrousel extends \yii\db\ActiveRecord
{
    public $carrousel;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_main_carrousel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['carrousel'], 'required'],
           // [['carrousel'], 'file','maxFiles' => 10,'extensions' => 'png, jpg, jpeg, gif', 'skipOnEmpty' => true],
            [['size'], 'integer'],
            [['time'], 'safe'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

   public function beforeDelete()
{
    if (!parent::beforeDelete()) {
        return false;
    }

    unlink($this->path);
    return true;
}

    public function upload()
    {
       
            $folder = Yii::$app->basePath.'/main-carrousel/';
             FileHelper::createDirectory($folder, $mode = 0777, $recursive = true);
                $this->carrousel->saveAs($folder.$this->carrousel->baseName.'.'.$this->carrousel->extension);
                $this->path = $folder.$this->carrousel->baseName.'.'.$this->carrousel->extension;
                $this->size = $this->carrousel->size;
           if ($this->save()) {
            return true;
        } else {
            return false;
        }
    }


       
       public function uploadup($id)
    {
        if ($this->validate()) { 
            $folder = Yii::$app->basePath.'/main-carrousel/';
             FileHelper::createDirectory($folder, $mode = 0777, $recursive = true);
             
                $this->carrousel->saveAs($folder.$this->carrousel->baseName.'.'.$this->carrousel->extension);
                $modelcar = TMainCarrousel::findOne($id);
            if ($modelcar !== null) {
                unlink($modelcar->path);
                $modelcar->path = $folder.$this->carrousel->baseName.'.'.$this->carrousel->extension;
                $modelcar->size = $this->carrousel->size;
                $modelcar->save();
            }else{
                $modelcarn       = new TMainCarrousel();
                $modelcarn->path = $folder.$this->carrousel->baseName.'.'.$this->carrousel->extension;
                $modelcarn->size = $this->carrousel->size;
                $modelcarn->save();
                
            }
                
        
            return true;
        } else {
            return false;
        }
    }
}
