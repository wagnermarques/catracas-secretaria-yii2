<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{pessoas}}`.
 */
class m250621_035447_create_pessoas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{pessoas}}', [
            'id' =>  $this->primaryKey(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'emailpessoal' => $this->string(255)->unique(),            
            'idade' => $this->integer(),
            'rg' => $this->string(20)->unique(),
            'cpf' => $this->string(14)->unique(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{pessoas}}');
    }
}
