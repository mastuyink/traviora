<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_transport".
 *
 * @property integer $id
 * @property string $nama_transport
 * @property integer $id_jenis_trans
 * @property string $last_edit
 *
 * @property TJenisTrans $idJenisTrans
 */
class TTransport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_transport', 'id_jenis_trans'], 'required'],
            [['id_jenis_trans','id'], 'integer'],
            [['last_edit'], 'safe'],
            [['nama_transport'], 'string', 'max' => 50],
            [['id_jenis_trans'], 'exist', 'skipOnError' => true, 'targetClass' => TJenisTrans::className(), 'targetAttribute' => ['id_jenis_trans' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_transport' => 'Nama Transport',
            'id_jenis_trans' => 'Id Jenis Trans',
            'last_edit' => 'Last Edit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdJenisTrans()
    {
        return $this->hasOne(TJenisTrans::className(), ['id' => 'id_jenis_trans']);
    }
}
