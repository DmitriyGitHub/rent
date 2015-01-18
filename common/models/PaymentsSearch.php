<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Payments;

/**
 * PaymentsSearch represents the model behind the search form about `common\models\Payments`.
 */
class PaymentsSearch extends Payments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contract_id', 'type_id', 'service_id', 'created_at', 'updated_at'], 'integer'],
            [['number', 'date'], 'safe'],
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
        $query = Payments::find();

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
            'contract_id' => $this->contract_id,
            'type_id' => $this->type_id,
            'service_id' => $this->service_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }
}
