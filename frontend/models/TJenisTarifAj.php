<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_jenis_tarif_aj".
 *
 * @property integer $id
 * @property string $jenis_tarif
 *
 * @property TAntar[] $tAntars
 * @property TJemput[] $tJemputs
 * @property TTarifAj[] $tTarifAjs
 */
class TJenisTarifAj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_jenis_tarif_aj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_tarif'], 'required'],
            [['jenis_tarif'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'jenis_tarif' => Yii::t('app', 'Jenis Tarif'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTAntars()
    {
        return $this->hasMany(TAntar::className(), ['id_metode_antar' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTJemputs()
    {
        return $this->hasMany(TJemput::className(), ['id_metode_jemput' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTarifAjs()
    {
        return $this->hasMany(TTarifAj::className(), ['id_jenis_tarif' => 'id']);
    }
}
