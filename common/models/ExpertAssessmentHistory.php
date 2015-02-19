<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "expert_assessment_history".
 *
 * @property integer $id
 * @property string $date
 * @property string $amount
 * @property string $square
 * @property integer $contract_additions_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ContractAdditions $contractAdditions
 */
class ExpertAssessmentHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expert_assessment_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'contract_additions_id'], 'required'],
            [['date'], 'safe'],
            [['amount', 'square'], 'number'],
            [['contract_additions_id', 'created_at', 'updated_at'], 'integer']
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
            'square' => Yii::t('app', 'Square'),
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
