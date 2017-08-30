<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_metode_pembayaran".
 *
 * @property integer $id
 * @property string $metode
 *
 * @property TPembayaran[] $tPembayarans
 */
class TMetodePembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_metode_pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['metode'], 'required', 'message' => '{attribute} Harus Di Isi'],
            [['metode'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metode' => 'Metode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTPembayarans()
    {
        return $this->hasMany(TPembayaran::className(), ['id_metode' => 'id']);
    }
}
