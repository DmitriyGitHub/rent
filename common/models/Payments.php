<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payments".
 *
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $amount
 * @property integer $contract_id
 * @property integer $type_id
 * @property integer $service_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contracts $contract
 * @property ServicesType $service
 * @property PaymentsType $type
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['amount'], 'required'],
            [['amount'], 'number'],
            [['contract_id', 'type_id', 'service_id', 'created_at', 'updated_at'], 'integer'],
            [['number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'date' => Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Amount'),
            'contract_id' => Yii::t('app', 'Contract ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contracts::className(), ['id' => 'contract_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(ServicesType::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PaymentsType::className(), ['id' => 'type_id']);
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
