<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "organisations".
 *
 * @property integer $id
 * @property string $name
 * @property string $okpo
 * @property string $legal_address
 * @property string $real_address
 * @property integer $budget_org
 * @property integer $general_org
 * @property integer $vat_payer
 * @property integer $self_org
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Contracts[] $contracts
 */
class Organisations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organisations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['budget_org', 'general_org', 'vat_payer', 'self_org', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'okpo', 'legal_address', 'real_address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Organisation name'),
            'okpo' => Yii::t('app', 'Organisation OKPO'),
            'legal_address' => Yii::t('app', 'Organisation legal address'),
            'real_address' => Yii::t('app', 'Organisation real address'),
            'budget_org' => Yii::t('app', 'Budget organisation'),
            'general_org' => Yii::t('app', 'General organisation'),
            'vat_payer' => Yii::t('app', 'VAT payment organisation'),
            'self_org' => Yii::t('app', 'Self organisation'),
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
        return $this->hasMany(Contracts::className(), ['organisation_id' => 'id']);
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
