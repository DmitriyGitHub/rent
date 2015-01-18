<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "streets".
 *
 * @property integer $id
 * @property string $name
 * @property integer $street_type
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Houses[] $houses
 * @property StreetsTypes $streetType
 */
class Streets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'street_type'], 'required'],
            [['street_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Street name'),
            'street_type' => Yii::t('app', 'Street type ID'),
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
        return $this->hasMany(Houses::className(), ['street' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreetType()
    {
        return $this->hasOne(StreetsTypes::className(), ['id' => 'street_type']);
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
