<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contracts_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $code
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contracts[] $contracts
 */
class ContractsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contracts_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'code'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Contract type name'),
            'description' => Yii::t('app', 'Contract type description'),
            'code' => Yii::t('app', 'Contract type code'),
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
        return $this->hasMany(Contracts::className(), ['type_id' => 'id']);
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
