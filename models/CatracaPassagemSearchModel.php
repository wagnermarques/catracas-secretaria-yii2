<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CatracaPassagem;

/**
 * CatracaPassagemSearchModel represents the model behind the search form of `app\models\CatracaPassagem`.
 */
class CatracaPassagemSearchModel extends CatracaPassagem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'catracaid'], 'integer'],
            [['cartaoid', 'timestampdapassagem', 'status'], 'safe'],
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
        $query = CatracaPassagem::find();

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
            'catracaid' => $this->catracaid,
            'timestampdapassagem' => $this->timestampdapassagem,
        ]);

        $query->andFilterWhere(['like', 'cartaoid', $this->cartaoid])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
