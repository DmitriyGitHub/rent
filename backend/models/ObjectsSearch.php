<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Objects;

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
        
        $query->joinWith('house');
        $query->joinWith('house.street');
        $dataProvider->sort->attributes['houseAddress'] = [
            'asc' => ['streets.name' => SORT_ASC, 'houses.number' => SORT_ASC, 'houses.letter' => SORT_ASC],
            'desc' => ['streets.name' => SORT_DESC, 'houses.number' => SORT_DESC, 'houses.letter' => SORT_DESC],
            'default' => SORT_ASC,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        if($this->houseAddress){
            $houseAddressData = trim($this->houseAddress);
            $houseAddressData = explode('.', $this->houseAddress);
            if(count($houseAddressData) > 1){
                $query->joinWith('house.street.streetType');
                $query->andFilterWhere(['like', 'streets_types.short_name', trim($houseAddressData[0])]);
                unset($houseAddressData[0]);
                $houseAddressData = join('.', $houseAddressData);
            }
            else{
                $houseAddressData = $houseAddressData[0];
            }

            $houseAddressData = trim($houseAddressData);
            $houseAddressData = explode(',', $houseAddressData);

            if(!empty($houseAddressData[0])){
                $query->andFilterWhere(['like', 'streets.name', trim($houseAddressData[0])]);
                unset($houseAddressData[0]);
                if(!empty($houseAddressData[1])){
                    $houseAddressData = trim($houseAddressData[1]);
                    $houseAddressData = explode('-', $houseAddressData);
                    if(!empty($houseAddressData[0])){
                        $query->andFilterWhere(['like', 'houses.number', trim($houseAddressData[0])]);
                        if(!empty($houseAddressData[1])){
                            $query->andFilterWhere(['like', 'houses.letter', trim($houseAddressData[1])]);
                        }
                    }
                }
            }
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
