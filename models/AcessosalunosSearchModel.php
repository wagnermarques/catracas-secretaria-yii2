<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acessosalunos;

/**
 * AcessosalunosSearchModel represents the model behind the search form of `app\models\Acessosalunos`.
 */
class AcessosalunosSearchModel extends Acessosalunos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno'], 'integer'],
            [['timestampdapassagem', 'timestampdoupdatepranuvem', 'timestampdoupdatepranuvemAtUploading', 'data_acesso', 'hora_acesso'], 'safe'],
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
        $query = Acessosalunos::find();

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
            'data_acesso' => $this->data_acesso,
            'hora_acesso' => $this->hora_acesso,
            'timestampdapassagem' => $this->timestampdapassagem,
            'timestampdoupdatepranuvem' => $this->timestampdoupdatepranuvem,
            'timestampdoupdatepranuvemAtUploading' => $this->timestampdoupdatepranuvemAtUploading,
        ]);

        return $dataProvider;
    }
}
