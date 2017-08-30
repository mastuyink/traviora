<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_area_aj".
 *
 * @property integer $id
 * @property integer $id_lokasi_aj
 * @property string $nama_area
 * @property string $datetime
 *
 * @property TLokasiAj $idLokasiAj
 * @property TTarifAj[] $tTarifAjs
 */
class AreaAj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_area_aj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_lokasi_aj', 'nama_area'], 'required'],
            [['id_lokasi_aj'], 'integer'],
            [['datetime'], 'safe'],
            [['nama_area'], 'string', 'max' => 50],
            [['id_lokasi_aj'], 'exist', 'skipOnError' => true, 'targetClass' => TLokasiAj::className(), 'targetAttribute' => ['id_lokasi_aj' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_lokasi_aj' => Yii::t('app', 'Area'),
            'nama_area' => Yii::t('app', 'Nama Lokasi / tempat'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLokasiAj()
    {
        return $this->hasOne(TLokasiAj::className(), ['id' => 'id_lokasi_aj']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTarifAjs()
    {
        return $this->hasMany(TTarifAj::className(), ['id_area' => 'id']);
    }
}
