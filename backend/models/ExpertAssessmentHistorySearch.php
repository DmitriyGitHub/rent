<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExpertAssessmentHistory;

/**
 * ExpertAssessmentHistorySearch represents the model behind the search form about `common\models\ExpertAssessmentHistory`.
 */
class ExpertAssessmentHistorySearch extends ExpertAssessmentHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contract_additions_id', 'created_at', 'updated_at'], 'integer'],
            [['date'], 'safe'],
            [['amount', 'square'], 'number'],
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
        $query = ExpertAssessmentHistory::find();

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
            'date' => $this->date,
            'amount' => $this->amount,
            'square' => $this->square,
            'contract_additions_id' => $this->contract_additions_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
