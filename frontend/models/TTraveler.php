<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_traveler".
 *
 * @property integer $id
 * @property integer $id_leader
 * @property string $nama
 * @property integer $id_jenis_anggota
 * @property string $datetime
 *
 * @property TKategoriTraveler $idJenisAnggota
 * @property TCustomer $idLeader
 */
class TTraveler extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_traveler';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['id_leader', 'id_jenis_anggota'], 'integer'],
            [['datetime'], 'safe'],
            [['nama'], 'string', 'max' => 50],
            [['id_jenis_anggota'], 'exist', 'skipOnError' => true, 'targetClass' => TKategoriTraveler::className(), 'targetAttribute' => ['id_jenis_anggota' => 'id']],
            [['id_leader'], 'exist', 'skipOnError' => true, 'targetClass' => TCustomer::className(), 'targetAttribute' => ['id_leader' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_leader' => 'Leader Trip',
            'nama' => 'Traveler Name',
            'id_jenis_anggota' => 'Type Traveler',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisAnggota()
    {
        return $this->hasOne(TKategoriTraveler::className(), ['id' => 'id_jenis_anggota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLeader()
    {
        return $this->hasOne(TCustomer::className(), ['id' => 'id_leader']);
    }
}
