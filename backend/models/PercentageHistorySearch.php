<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PercentageHistory;

/**
 * PercentageHistorySearch represents the model behind the search form about `common\models\PercentageHistory`.
 */
class PercentageHistorySearch extends PercentageHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contract_additions_id', 'created_at', 'updated_at'], 'integer'],
            [['start_date', 'use_purpose'], 'safe'],
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
        $query = PercentageHistory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'amount' => $this->amount,
            'contract_additions_id' => $this->contract_additions_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'use_purpose', $this->use_purpose]);

        return $dataProvider;
    }
}
