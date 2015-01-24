<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Houses;

/**
 * HousesSearch represents the model behind the search form about `common\models\Houses`.
 */
class HousesSearch extends Houses
{
    public $streetName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'part_type', 'street_id', 'sector_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['streetName', 'letter', 'part'], 'safe'],
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
        $query = Houses::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//                var_dump($dataProvider->getSort()->attributes['part']);exit();
        $query->joinWith('street');
        $dataProvider->sort->attributes['streetName'] = [
            'asc' => ['streets.name' => SORT_ASC],
            'desc' => ['streets.name' => SORT_DESC],
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
            'part_type' => $this->part_type,
            'sector_id' => $this->sector_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        
        $query->andFilterWhere(['like', 'streets.name', $this->streetName]);

        $query->andFilterWhere(['like', 'number', $this->number]);
        
        $query->andFilterWhere(['like', 'letter', $this->letter])
            ->andFilterWhere(['like', 'part', $this->part]);

        return $dataProvider;
    }
}
