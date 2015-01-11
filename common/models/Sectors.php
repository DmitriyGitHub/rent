<?php

namespace common\models;

use Yii;

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
            [['name', 'description', 'sector_district'], 'required'],
            [['sector_district', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'sector_district' => Yii::t('app', 'Sector district'),
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
    public function getSectorDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'sector_district']);
    }
}
