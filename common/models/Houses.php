<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "houses".
 *
 * @property integer $id
 * @property integer $number
 * @property string $letter
 * @property integer $part_type
 * @property string $part
 * @property integer $street_id
 * @property integer $sector_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Sectors $sector
 * @property Streets $street
 * @property Objects[] $objects
 */
class Houses extends \yii\db\ActiveRecord
{
    const PART_TYPE_FULL = 10;
    const PART_TYPE_PARTIAL = 11;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'street_id', 'sector_id'], 'required'],
            [['number', 'part_type', 'street_id', 'sector_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['letter', 'part'], 'string', 'max' => 255],
            [
                'part',
                'required',
                'when' => function($model){
                    return $model->part_type != self::PART_TYPE_FULL;
                },
                'whenClient' => "function (attribute, value) {
                    return parseFloat($('#" . \yii\helpers\Html::getInputId($this, 'part_type') . "').val()) != " . self::PART_TYPE_FULL . ";
                }",
            ],
            [['part_type'], 'default', 'value' => self::PART_TYPE_FULL],
            [['part_type'], 'in', 'range' => [self::PART_TYPE_FULL, self::PART_TYPE_PARTIAL]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'House number'),
            'letter' => Yii::t('app', 'House letter'),
            'part_type' => Yii::t('app', 'House part type'),
            'part' => Yii::t('app', 'House part description'),
            'street_id' => Yii::t('app', 'House street ID'),
            'sector_id' => Yii::t('app', 'House sector ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->hasOne(Sectors::className(), ['id' => 'sector_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreet()
    {
        return $this->hasOne(Streets::className(), ['id' => 'street_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['house_id' => 'id']);
    }
    
    public function getPartDescription(){        
        $partDescription = "";
        if(!empty($this->partTypesList[$this->part_type])){
            $partDescription .= $this->partTypesList[$this->part_type];
        }
        if($this->part_type == self::PART_TYPE_PARTIAL){
            $partDescription .= ' - ' . $this->part;
        }
        return $partDescription;
    }
    
    public static function getPartTypesList(){
        return [
            self::PART_TYPE_FULL => Yii::t('app', 'Full'),
            self::PART_TYPE_PARTIAL => Yii::t('app', 'Partial'),
        ];
    }
    
    public function getSectorPath(){
        return $this->sector->name . ' (' . $this->sector->district->name . ')';
    }
    
    public function getFullAddress(){
        $fullAddress = $this->street->streetType->short_name . ' ' . $this->street->name . ', ' . $this->number;
        if($this->letter && $this->letter != ""){
            $fullAddress .= '-' . $this->letter;
        }
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
