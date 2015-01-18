<?php

namespace common\models;

use Yii;

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
 * @property integer $contract_type
 * @property string $square
 * @property string $descriptions
 * @property string $initial_price
 * @property string $account_number
 * @property integer $object_part_id
 * @property string $object_part_additional
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Objects $object
 * @property ContractsType $contractType
 * @property Organisations $organisation
 */
class Contracts extends \yii\db\ActiveRecord
{
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
            [['number', 'created_at', 'updated_at'], 'required'],
            [['date', 'start_date', 'end_date'], 'safe'],
            [['object_id', 'organisation_id', 'status', 'contract_type', 'object_part_id', 'created_at', 'updated_at'], 'integer'],
            [['square', 'initial_price'], 'number'],
            [['number', 'descriptions', 'account_number', 'object_part_additional'], 'string', 'max' => 255]
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
            'contract_type' => Yii::t('app', 'Contract Type'),
            'square' => Yii::t('app', 'Square'),
            'descriptions' => Yii::t('app', 'Descriptions'),
            'initial_price' => Yii::t('app', 'Initial Price'),
            'account_number' => Yii::t('app', 'Account Number'),
            'object_part_id' => Yii::t('app', 'Object Part ID'),
            'object_part_additional' => Yii::t('app', 'Object Part Additional'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
    public function getContractType()
    {
        return $this->hasOne(ContractsType::className(), ['id' => 'contract_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organisations::className(), ['id' => 'organisation_id']);
    }
}
