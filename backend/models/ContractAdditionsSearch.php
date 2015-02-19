<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContractAdditions;

/**
 * ContractAdditionsSearch represents the model behind the search form about `common\models\ContractAdditions`.
 */
class ContractAdditionsSearch extends ContractAdditions
{
    public $contract_number;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['date', 'number', 'contract_number', 'description'], 'safe'],
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
        $query = ContractAdditions::find();

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
        $query->joinWith('contract');

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'contracts.number', $this->contract_number])
            ->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }
}
