<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carteirinha;

/**
 * CarteirinhaSearchModel represents the model behind the search form of `app\models\Carteirinha`.
 */
class CarteirinhaSearchModel extends Carteirinha
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'ativa'], 'integer'],
            [['data_emissao', 'data_validade', 'observacao'], 'safe'],
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
        $query = Carteirinha::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_aluno' => $this->id_aluno,
            'data_emissao' => $this->data_emissao,
            'data_validade' => $this->data_validade,
            'ativa' => $this->ativa,
        ]);

        $query->andFilterWhere(['like', 'observacao', $this->observacao]);

        return $dataProvider;
    }
}
