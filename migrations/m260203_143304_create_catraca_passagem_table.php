<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%catraca_passagem}}`.
 */
class m260203_143304_create_catraca_passagem_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%catraca_passagem}}', [
            'id' => $this->primaryKey(),
            'id_aluno' => $this->integer(),
            'cartaoid' => $this->string(255),
            'catracaid' => $this->integer(),
            'timestampdapassagem' => $this->dateTime(),
            'status' => $this->string(50),
        ]);

        // Optional: add foreign key if id_aluno exists
        $this->addForeignKey(
            'fk-catraca_passagem-id_aluno',
            '{{%catraca_passagem}}',
            'id_aluno',
            '{{%alunos}}',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%catraca_passagem}}');
    }
}
