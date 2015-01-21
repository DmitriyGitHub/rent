<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contract_price_history".
 *
 * @property integer $id
 * @property string $date
 * @property string $amount
 * @property integer $contract_id
 * @property string $addition_number
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contracts $contract
 */
class ContractPriceHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract_price_history';
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
            [['contract_id', 'created_at', 'updated_at'], 'integer'],
            [['addition_number', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Amount'),
            'contract_id' => Yii::t('app', 'Contract ID'),
            'addition_number' => Yii::t('app', 'Contract addition number'),
            'description' => Yii::t('app', 'Description'),
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
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
