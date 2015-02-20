<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contract_additions".
 *
 * @property integer $id
 * @property string $date
 * @property integer $contract_id
 * @property string $number
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contracts $contract
 * @property ContractPriceHistory[] $contractPriceHistories
 * @property ExpertAssessmentHistory[] $expertAssessmentHistories
 * @property PercentageHistory[] $percentageHistories
 */
class ContractAdditions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contract_additions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['contract_id'], 'required'],
            [['contract_id', 'created_at', 'updated_at'], 'integer'],
            [['number', 'description'], 'string', 'max' => 255]
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
            'contract_id' => Yii::t('app', 'Contract ID'),
            'number' => Yii::t('app', 'Contract addition number'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getContractPriceHistory()
    {
        return $this->hasOne(ContractPriceHistory::className(), ['contract_additions_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpertAssessmentHistory()
    {
        return $this->hasOne(ExpertAssessmentHistory::className(), ['contract_additions_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentageHistory()
    {
        return $this->hasOne(PercentageHistory::className(), ['contract_additions_id' => 'id']);
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
