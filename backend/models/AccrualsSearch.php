<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Accruals;

/**
 * AccrualsSearch represents the model behind the search form about `common\models\Accruals`.
 */
class AccrualsSearch extends Accruals
{
    public $contract_number;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contract_id', 'service_id', 'created_at', 'updated_at'], 'integer'],
            [['date', 'contract_number'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Accruals::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['contract_number'] = [
            'asc' => ['contracts.number' => SORT_ASC],
            'desc' => ['contracts.number' => SORT_DESC],
            'default' => SORT_ASC,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'amount' => $this->amount,
            'service_id' => $this->service_id,
        ]);
        
        $query->joinWith('contract');
        $query->andFilterWhere(['like', 'contracts.number', $this->contract_number]);

        return $dataProvider;
    }
}
