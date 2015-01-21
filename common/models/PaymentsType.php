<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "payments_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Payments[] $payments
 */
class PaymentsType extends \yii\db\ActiveRecord
{
    const ID_PAYMENT_RENT = 1;
    const ID_PAYMENT_MUTUAL = 2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Payment type name'),
            'description' => Yii::t('app', 'Payment type description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['type_id' => 'id']);
    }
    
    public static function getNonRemovable(){
        return [
            self::ID_PAYMENT_MUTUAL,
            self::ID_PAYMENT_RENT,
        ];
    }
    
    public function beforeDelete() {
        if(parent::beforeDelete()){
            if(in_array($this->id, $this->nonRemovable)){
                return FALSE;
            }
            return TRUE;
        }
        return FALSE;
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
