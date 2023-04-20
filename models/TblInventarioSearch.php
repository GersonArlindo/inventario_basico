<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblInventario;
use app\models\TblProductos;

/**
 * TblInventarioSearch represents the model behind the search form of `app\models\TblInventario`.
 */
class TblInventarioSearch extends TblInventario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_inventario', 'id_producto', 'cantidad', 'id_usuario'], 'integer'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TblInventario::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id_producto' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_inventario' => $this->id_inventario,
            'id_producto' => $this->id_producto,
            'cantidad' => $this->cantidad,
            'fecha_ing' => $this->fecha_ing,
            'fecha_mod' => $this->fecha_mod,
            'id_usuario' => $this->id_usuario,
        ]);

        return $dataProvider;
    }
}
