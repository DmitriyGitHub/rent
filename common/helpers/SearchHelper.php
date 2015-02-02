<?php

namespace common\helpers;

class SearchHelper 
{
    public static function sortByHouse($attributeName, $dataProvider, $query, $base = ''){
        $query->joinWith($base . 'house');
        $query->joinWith($base . 'house.street');
        $dataProvider->sort->attributes[$attributeName] = [
            'asc' => ['streets.name' => SORT_ASC, 'houses.number' => SORT_ASC, 'houses.letter' => SORT_ASC],
            'desc' => ['streets.name' => SORT_DESC, 'houses.number' => SORT_DESC, 'houses.letter' => SORT_DESC],
            'default' => SORT_ASC,
        ];
    }
        
    public static function filterByHouse($houseAddress, $query, $base = ''){
        $query->joinWith($base . 'house');
        $query->joinWith($base . 'house.street');
        $houseAddressData = trim($houseAddress);
        $houseAddressData = explode('.', $houseAddress);
        if(count($houseAddressData) > 1){
            $query->joinWith($base . 'house.street.streetType');
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
                        //Do not use anything after space.
                        $houseAddressData = explode(' ', $houseAddressData[1]);
                        $query->andFilterWhere(['like', 'houses.letter', trim($houseAddressData[0])]);
                    }
                }
            }
        }
    }
}

