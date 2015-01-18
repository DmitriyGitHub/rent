<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sectors".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $sector_district
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Houses[] $houses
 * @property Districts $sectorDistrict
 */
class Sectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sectors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'district_id'], 'required'],
            [['district_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Sector name'),
            'description' => Yii::t('app', 'Sector description'),
            'district_id' => Yii::t('app', 'Sector district ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(Houses::className(), ['sector' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }
    
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
