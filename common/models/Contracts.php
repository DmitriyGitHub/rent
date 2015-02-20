<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contracts".
 *
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property string $start_date
 * @property string $end_date
 * @property integer $object_id
 * @property integer $organisation_id
 * @property integer $status
 * @property integer $type_id
 * @property string $square
 * @property string $descriptions
 * @property string $initial_price
 * @property string $account_number
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Accruals[] $accruals
 * @property ContractPriceHistory[] $contractPriceHistories
 * @property ContractsType $type
 * @property Objects $object
 * @property Organisations $organisation
 * @property ExpertAssessmentHistory[] $expertAssessmentHistories
 * @property Payments[] $payments
 * @property PercentageHistory[] $percentageHistories
 * @property ContractAdditions[] $contractAdditions
 */
class Contracts extends \yii\db\ActiveRecord
{
    
    public $expertAssessmentSquare;
    public $expertAssessmentAmount;
    public $price;
    public $percentage;
    public $usePurpose;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['date', 'start_date', 'end_date'], 'safe'],
            [['object_id', 'organisation_id', 'status', 'type_id', 'created_at', 'updated_at'], 'integer'],
            [['expertAssessmentSquare', 'price', '$expertAssessmentAmount', 'percentage'], 'number'],
            [['number', 'descriptions', 'account_number', 'usePurpose'], 'string', 'max' => 255]
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
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'object_id' => Yii::t('app', 'Object ID'),
            'organisation_id' => Yii::t('app', 'Organisation ID'),
            'status' => Yii::t('app', 'Status'),
            'type_id' => Yii::t('app', 'Type ID'),
            'square' => Yii::t('app', 'Square'),
            'descriptions' => Yii::t('app', 'Descriptions'),
            'initial_price' => Yii::t('app', 'Initial Price'),
            'account_number' => Yii::t('app', 'Account Number'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccruals()
    {
        return $this->hasMany(Accruals::className(), ['contract_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractPriceHistories()
    {
        return $this->hasMany(ContractPriceHistory::className(), ['contract_id' => 'id'])->via('contractAdditions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ContractsType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(Objects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organisations::className(), ['id' => 'organisation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpertAssessmentHistories()
    {
        return $this->hasMany(ExpertAssessmentHistory::className(), ['contract_id' => 'id'])->via('contractAdditions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['contract_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPercentageHistories()
    {
        return $this->hasMany(PercentageHistory::className(), ['contract_id' => 'id'])->via('contractAdditions');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractAdditions()
    {
        return $this->hasMany(ContractAdditions::className(), ['contract_id' => 'id']);
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
    
    public function getLatestPayment(){
        $latestPayment = $this->getPayments()->orderBy(['date' => SORT_DESC])->one();
        if($latestPayment){
            return $latestPayment->amount;
}
        return '';
    }
    
    public function getLatestAccrual(){
        $latestAccrual = $this->getAccruals()->orderBy(['date' => SORT_DESC])->one();
        if($latestAccrual){
            return $latestAccrual->amount;
        }
        return '';
    }
    
    private function getCurrentExpertAssessmentHistoryItem(){
        $expertAssessmentHistoryItem = $this->getExpertAssessmentHistories()
                ->andWhere(['<=', 'start_date', date('Y-m-d')])
                ->orderBy(['start_date' => SORT_DESC])
                ->one();
        if(!$expertAssessmentHistoryItem){
            //TODO: No square found. Throw an error probably.
            return new ExpertAssessmentHistory();
        }
        return $expertAssessmentHistoryItem;
    }
    
    public function getExpertAssessmentSquare(){
        return $this->currentExpertAssessmentHistoryItem->square;
    }
    
    public function getExpertAssessmentAmount(){
        return $this->currentExpertAssessmentHistoryItem->amount;
    }

    
    private function getPercentageHistoryItem(){
        $percentageHistoryItem = $this->getPercentageHistories()
                ->andWhere(['<=', 'start_date', date('Y-m-d')])
                ->orderBy(['start_date' => SORT_DESC])
                ->one();
        if(!$percentageHistoryItem){
            //TODO: No square found. Throw an error probably.
            return new PercentageHistory();
        }
        return $percentageHistoryItem;
    }
    
    public function getPercentage(){
        return $this->currentPercentageHistoryItem->amount;
    }
    
    public function getUsePurpose(){
        return $this->currentPercentageHistoryItem->use_purpose;
    }
    
    private function getPriceHistoryItem(){
        $percentageHistoryItem = $this->getPercentageHistories()
                ->andWhere(['<=', 'start_date', date('Y-m-d')])
                ->orderBy(['start_date' => SORT_DESC])
                ->one();
        if(!$percentageHistoryItem){
            //TODO: No square found. Throw an error probably.
            return new PercentageHistory();
        }
        return $percentageHistoryItem;
    }
    
    public function getPrice(){
        return $this->priceHistoryItem->amount;
    }
}
