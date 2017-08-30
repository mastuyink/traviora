<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_supplier".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $no_telp
 * @property string $email
 * @property string $site
 * @property string $create_at
 * @property string $update_at
 *
 * @property TDestinasi[] $tDestinasis
 */
class TSupplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'no_telp', 'email'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['nama', 'alamat', 'site'], 'string', 'max' => 50],
            [['no_telp'], 'string', 'max' => 15],
             [['email'], 'email'],
            [['email'], 'string', 'max' => 25],
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
            'alamat' => Yii::t('app', 'Alamat'),
            'no_telp' => Yii::t('app', 'No Telp'),
            'email' => Yii::t('app', 'Email'),
            'site' => Yii::t('app', 'Site'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDestinasis()
    {
        return $this->hasMany(TDestinasi::className(), ['id_supplier' => 'id']);
    }
}
