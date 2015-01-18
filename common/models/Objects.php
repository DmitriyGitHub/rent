<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "objects".
 *
 * @property integer $id
 * @property integer $house_id
 * @property integer $part_type_id
 * @property string $part_description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contracts[] $contracts
 * @property ObjectParts $partType
 * @property Houses $house
 */
class Objects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'part_type_id'], 'required'],
            [['house_id', 'part_type_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['part_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'house_id' => Yii::t('app', 'Object house ID'),
            'part_type_id' => Yii::t('app', 'Object part type ID'),
            'part_description' => Yii::t('app', 'Object part description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartType()
    {
        return $this->hasOne(ObjectParts::className(), ['id' => 'part_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(Houses::className(), ['id' => 'house_id']);
    }
    
    public function getFullAddress(){
        $fullAddress = $this->house->fullAddress . ' ' . $this->partType->name;
        //TMP
        $fullAddress .= ' ' . $this->part_description;
        return $fullAddress;
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
