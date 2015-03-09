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
 * @property integer $contract_additions_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ContractAdditions $contractAdditions
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
            [['start_date'], 'safe'],
            [['amount', 'contract_additions_id'], 'required'],
            [['amount'], 'number'],
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
            'start_date' => Yii::t('app', 'Date'),
            'amount' => Yii::t('app', 'Price'),
            'contract_additions_id' => Yii::t('app', 'Contract Additions ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractAddition()
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
