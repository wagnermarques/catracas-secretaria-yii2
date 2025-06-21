<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%acessosalunos}}`.
 */
class m250621_185434_create_acessosalunos_table extends Migration
{
/**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%acessosalunos}}', [
            'id' => $this->primaryKey(),
            'id_aluno' => $this->integer()->notNull(), // Coluna para a chave estrangeira
            'timestampdapassagem' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'), // TIMESTAMP com valor padrão
            'timestampdoupdatepranuvem' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'), // TIMESTAMP com atualização automática
            'timestampdoupdatepranuvemAtUploading' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'), // TIMESTAMP com atualização automática
            'data_acesso' => $this->date()->notNull(),  // DATE para data
            'hora_acesso' => $this->time()->notNull(),  // TIME para hora
        ]);

        // Adiciona a chave estrangeira para a tabela `alunos`
        $this->addForeignKey(
            'fk-acessosalunos-id_aluno', // Nome da chave estrangeira (único e descritivo)
            '{{%acessosalunos}}',         // Tabela que possui a chave estrangeira
            'id_aluno',                   // Coluna na tabela `acessosalunos`
            '{{%alunos}}',                // Tabela referenciada
            'id',                         // Coluna referenciada na tabela `alunos`
            'CASCADE'                     // Ação ao deletar (CASCADE, SET NULL, RESTRICT, etc.)
                                          // CASCADE: Se um aluno for deletado, seus acessos também serão.
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Remove a chave estrangeira primeiro
        $this->dropForeignKey(
            'fk-acessosalunos-id_aluno',
            '{{%acessosalunos}}'
        );

        // Então, dropa a tabela
        $this->dropTable('{{%acessosalunos}}');
    }
}
