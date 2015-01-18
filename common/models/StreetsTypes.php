<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "streets_types".
 *
 * @property integer $id
 * @property string $short_name
 * @property string $full_name
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Streets[] $streets
 */
class StreetsTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streets_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name', 'full_name'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['short_name', 'full_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_name' => Yii::t('app', 'Street type short name'),
            'full_name' => Yii::t('app', 'Street type full name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreets()
    {
        return $this->hasMany(Streets::className(), ['street_type' => 'id']);
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
