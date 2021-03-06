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
    
    private $expertAssessmentSquare;
    private $expertAssessmentAmount;
    private $price;
    private $percentage;
    private $usePurpose;
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
            [['expertAssessmentSquare', 'price', 'expertAssessmentAmount', 'percentage'], 'number'],
            [['number', 'descriptions', 'account_number', 'usePurpose'], 'string', 'max' => 255],
            [['expertAssessmentSquare', 'price', 'expertAssessmentAmount', 'percentage', 'usePurpose'], 'required', 'on' => 'insert']
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
            'expertAssessmentSquare' => Yii::t('app', 'Square'),
            'expertAssessmentAmount' => Yii::t('app', 'Expert assessment'),
            'price' => Yii::t('app', 'Price'),
            'percentage' => Yii::t('app', 'Percentage'),
            'usePurpose' => Yii::t('app', 'Use purpose'),
            'latestAccrual' => Yii::t('app', 'Latest accrual'),
            'latestPayment' => Yii::t('app', 'Latest payment'),
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
        return $this->hasMany(ContractPriceHistory::className(), ['contract_additions_id' => 'id'])->via('contractAdditions');
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
        return $this->hasMany(ExpertAssessmentHistory::className(), ['contract_additions_id' => 'id'])->via('contractAdditions');
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
        return $this->hasMany(PercentageHistory::className(), ['contract_additions_id' => 'id'])->via('contractAdditions');
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
        if(!empty($this->expertAssessmentSquare)){
            return $this->expertAssessmentSquare;
        }
        return $this->getCurrentExpertAssessmentHistoryItem()->square;
    }
    
    public function getExpertAssessmentAmount(){
        if(!empty($this->expertAssessmentAmount)){
            return $this->expertAssessmentAmount;
        }
        return $this->getCurrentExpertAssessmentHistoryItem()->amount;
    }

    
    private function getCurrentPercentageHistoryItem(){
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
        if(!empty($this->percentage)){
            return $this->percentage;
        }
        return $this->getCurrentPercentageHistoryItem()->amount;
    }
    
    public function getUsePurpose(){
        if(!empty($this->usePurpose)){
            return $this->usePurpose;
        }
        return $this->getCurrentPercentageHistoryItem()->use_purpose;
    }
    
    private function getCurrentPriceHistoryItem(){
        $percentageHistoryItem = $this->getContractPriceHistories()
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
        if(!empty($this->price)){
            return $this->price;
        }
        return $this->getCurrentPriceHistoryItem()->amount;
    }
    
    public function setExpertAssessmentSquare($square){
        $this->expertAssessmentSquare = $square;
    }
    
    public function setExpertAssessmentAmount($amount){
        $this->expertAssessmentAmount = $amount;
    }
    
    public function setPercentage($amount){
        return $this->percentage = $amount;
    }
    
    public function setUsePurpose($use_purpose){
        return $this->usePurpose = $use_purpose;
    }
    
    public function setPrice($price){
        return $this->price = $price;
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            $contractAddition = new ContractAdditions();
            $contractAddition->contract_id = $this->id;
            $contractAddition->number = $this->number;
            $contractAddition->date = $this->date;
            $contractAddition->save();
            
            $items['expertAssessment'] = new ExpertAssessmentHistory();
            $items['expertAssessment']->amount = $this->expertAssessmentAmount;
            $items['expertAssessment']->square = $this->expertAssessmentSquare;
            
            $items['price'] = new ContractPriceHistory();
            $items['price']->amount = $this->price;
            
            $items['percentage'] = new PercentageHistory();
            $items['percentage']->amount = $this->percentage;
            $items['percentage']->use_purpose = $this->usePurpose;
            
            foreach($items as $item){
                $item->contract_additions_id = $contractAddition->id;
                $item->start_date = $this->start_date;
                $item->save();
            }            
        }
    }
}
