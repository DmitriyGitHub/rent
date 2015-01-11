<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "objects".
 *
 * @property integer $id
 * @property string $name
 * @property integer $address
 * @property integer $part_type
 * @property string $part_description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ObjectParts $partType
 * @property Houses $address0
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
            [['name', 'address', 'part_type'], 'required'],
            [['address', 'part_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'part_description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Object name'),
            'address' => Yii::t('app', 'Object address'),
            'part_type' => Yii::t('app', 'Object part type ID'),
            'part_description' => Yii::t('app', 'Object part description'),
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
    public function getPartType()
    {
        return $this->hasOne(ObjectParts::className(), ['id' => 'part_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress0()
    {
        return $this->hasOne(Houses::className(), ['id' => 'address']);
    }
}
