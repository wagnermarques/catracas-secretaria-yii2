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
    public $ra;
    public $aluno_nome;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno', 'ativa'], 'integer'],
            [['data_emissao', 'data_validade', 'observacao', 'ra', 'aluno_nome'], 'safe'],
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
        $query->joinWith(['aluno.pessoa']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['ra'] = [
            'asc' => ['alunos.ra' => SORT_ASC],
            'desc' => ['alunos.ra' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['aluno_nome'] = [
            'asc' => ['pessoas.firstname' => SORT_ASC],
            'desc' => ['pessoas.firstname' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'carteirinha.id' => $this->id,
            'id_aluno' => $this->id_aluno,
            //'data_emissao' => $this->data_emissao,
            //'data_validade' => $this->data_validade,
            'ativa' => $this->ativa,
        ]);

        $query->andFilterWhere(['like', 'observacao', $this->observacao])
              ->andFilterWhere(['like', 'alunos.ra', $this->ra])
              ->andFilterWhere(['or', 
                  ['like', 'pessoas.firstname', $this->aluno_nome],
                  ['like', 'pessoas.lastname', $this->aluno_nome]
              ]);

        if ($this->data_emissao) {
            $query->andFilterWhere(['like', 'data_emissao', \DateTime::createFromFormat('d/m/Y', $this->data_emissao)->format('Y-m-d')]);
        }
        if ($this->data_validade) {
             $query->andFilterWhere(['like', 'data_validade', \DateTime::createFromFormat('d/m/Y', $this->data_validade)->format('Y-m-d')]);
        }

        return $dataProvider;
    }
}
