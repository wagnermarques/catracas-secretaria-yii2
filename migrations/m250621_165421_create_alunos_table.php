<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{alunos}}`.
 */
class m250621_165421_create_alunos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%alunos}}', [
            'id' => $this->primaryKey(),
            'pessoa_id' => $this->integer()->notNull(), // Coluna para a chave estrangeira
            'ra' => $this->string(255)->notNull()->unique(),
            'aluno_status_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(), // Opcional: para TimeStampsBehavior
            'updated_at' => $this->integer(), // Opcional: para TimeStampsBehavior
        ]);

        // Adiciona a chave estrangeira para a tabela `pessoas`
        $this->addForeignKey(
            'fk-alunos-pessoa_id', // Nome da chave estrangeira
            '{{%alunos}}',        // Tabela que possui a chave estrangeira
            'pessoa_id',          // Coluna na tabela `alunos`
            '{{%pessoas}}',       // Tabela referenciada
            'id',                 // Coluna referenciada na tabela `pessoas`
            'CASCADE'             // Ação ao deletar (CASCADE, SET NULL, RESTRICT, etc.)
        );

        // Opcional: Adiciona a chave estrangeira para a tabela `aluno_status`
        // APENAS SE VOCÊ JÁ TIVER A TABELA aluno_status CRIADA
        $this->addForeignKey(
            'fk-alunos-aluno_status_id', // Nome da chave estrangeira
            '{{%alunos}}',                // Tabela que possui a chave estrangeira
            'aluno_status_id',            // Coluna na tabela `alunos`
            '{{%aluno_status}}',          // Tabela referenciada (certifique-se que ela existe)
            'id',                         // Coluna referenciada na tabela `aluno_status`
            'RESTRICT'                    // Ação ao deletar (RESTRICT é comum para status)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Remove a chave estrangeira primeiro
        $this->dropForeignKey(
            'fk-alunos-pessoa_id',
            '{{%alunos}}'
        );

        // Remove a chave estrangeira para aluno_status (se tiver adicionado)
        $this->dropForeignKey(
            'fk-alunos-aluno_status_id',
            '{{%alunos}}'
        );

        $this->dropTable('{{%alunos}}');
    }
}