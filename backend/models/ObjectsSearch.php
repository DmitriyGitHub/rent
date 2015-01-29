<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Objects;
use common\helpers\SearchHelper;

/**
 * ObjectsSearch represents the model behind the search form about `common\models\Objects`.
 */
class ObjectsSearch extends Objects
{
    public $houseAddress;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'house_id', 'part_type_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['houseAddress', 'part_description'], 'safe'],
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
        $query = Objects::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        SearchHelper::sortByHouse('houseAddress', $dataProvider, $query);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if($this->houseAddress){
            SearchHelper::filterByHouse($this->houseAddress, $query);
        }
        
        $query->andFilterWhere(['like', 'part_description', $this->part_description]);

        $query->andFilterWhere([
            'id' => $this->id,
            'house_id' => $this->house_id,
            'part_type_id' => $this->part_type_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'part_description', $this->part_description]);

        return $dataProvider;
    }
}
