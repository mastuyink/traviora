<?php

namespace app\models;

use Yii;
use yii\base\Model;
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
class VAnak extends Model
{
    const TRAVELER_ANAK = 2;
    public $nama;
    public $id_jenis_anggota;
    public $id_leader;
    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            ['id_jenis_anggota', 'default', 'value' => self::TRAVELER_ANAK],
            [['nama'], 'string', 'max' => 50],
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
            'id_leader' => 'Id Leader',
            'nama' => 'Nama',
            'id_jenis_anggota' => 'kategori',
            'datetime' => 'Datetime',
        ];
    }

   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLeader()
    {
        return $this->hasOne(TCustomer::className(), ['id' => 'id_leader']);
    }
}
