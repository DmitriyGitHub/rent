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
 * @property integer $street
 * @property integer $sector
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Sectors $sector0
 * @property Streets $street0
 * @property Objects[] $objects
 */
class Houses extends \yii\db\ActiveRecord
{
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
            [['number', 'part_type', 'street', 'sector'], 'required'],
            [['number', 'part_type', 'street', 'sector', 'status', 'created_at', 'updated_at'], 'integer'],
            [['letter', 'part'], 'string', 'max' => 255]
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
            'street' => Yii::t('app', 'House street ID'),
            'sector' => Yii::t('app', 'House sector ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector0()
    {
        return $this->hasOne(Sectors::className(), ['id' => 'sector']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreet0()
    {
        return $this->hasOne(Streets::className(), ['id' => 'street']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjects()
    {
        return $this->hasMany(Objects::className(), ['address' => 'id']);
    }
}
