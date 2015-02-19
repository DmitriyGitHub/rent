<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "percentage_history".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $amount
 * @property string $use_purpose
 * @property integer $contract_additions_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ContractAdditions $contractAdditions
 */
class PercentageHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'percentage_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'amount', 'contract_additions_id'], 'required'],
            [['start_date'], 'safe'],
            [['amount'], 'number'],
            [['contract_additions_id', 'created_at', 'updated_at'], 'integer'],
            [['use_purpose'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'amount' => Yii::t('app', 'Amount'),
            'use_purpose' => Yii::t('app', 'Use Purpose'),
            'contract_additions_id' => Yii::t('app', 'Contract Additions ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractAdditions()
    {
        return $this->hasOne(ContractAdditions::className(), ['id' => 'contract_additions_id']);
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
