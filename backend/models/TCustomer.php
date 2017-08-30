<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_customer".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $nama_customer
 * @property string $alamat
 * @property integer $id_jk
 * @property string $no_telp
 * @property integer $id_tipe_cust
 * @property string $total_transaksi
 * @property integer $total_passenger
 * @property string $create_at
 * @property string $update_at
 *
 * @property TBooking[] $tBookings
 * @property TJk $idJk
 * @property TTipeCust $idTipeCust
 * @property User $idUser
 * @property TTraveler[] $tTravelers
 */
class TCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_jk', 'no_telp', 'id_tipe_cust', 'total_transaksi', 'total_passenger'], 'integer', 'message' => '{attribute} Number Only'],
            [['nama_customer', 'no_telp','email'], 'required', 'message' => '{attribute} Harus Di Isi'],
            [['email'],'email'],
            [['create_at', 'update_at'], 'safe'],
            [['nama_customer'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 100],
            [['id_jk'], 'exist', 'skipOnError' => true, 'targetClass' => TJk::className(), 'targetAttribute' => ['id_jk' => 'id']],
            [['id_tipe_cust'], 'exist', 'skipOnError' => true, 'targetClass' => TTipeCust::className(), 'targetAttribute' => ['id_tipe_cust' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'nama_customer' => 'Nama Leader',
            'alamat' => 'Alamat',
            'id_jk' => 'Jenis Kelamin',
            'no_telp' => 'No Telp',
            'id_tipe_cust' => 'Jenis Pengguna',
            'total_transaksi' => 'Total Transaksi',
            'total_passenger' => 'Total Pax',
            'create_at' => 'Terdaftar pada',
            'update_at' => 'Terakhir Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBookings()
    {
        return $this->hasMany(TBooking::className(), ['id_customer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJk()
    {
        return $this->hasOne(TJk::className(), ['id' => 'id_jk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipeCust()
    {
        return $this->hasOne(TTipeCust::className(), ['id' => 'id_tipe_cust']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTravelers()
    {
        return $this->hasMany(TTraveler::className(), ['id_leader' => 'id']);
    }
}
