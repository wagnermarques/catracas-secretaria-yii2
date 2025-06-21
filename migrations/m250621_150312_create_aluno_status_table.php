<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aluno_status}}`.
 */
class m250621_150312_create_aluno_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aluno_status}}', [
            'id' => $this->primaryKey(),
            'status_do_aluno' => $this->string(100)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%aluno_status}}');
    }
}
