<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%address}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m250410_154902_create_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%address}}', [
            'user_id' => $this->primaryKey(),
            'adress' => $this->string(255),
            'city' => $this->string(255),
            'state' => $this->string(255),
            'country' => $this->string(45),
            'zipcode' => $this->string(45),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-address-user_id}}',
            '{{%address}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-address-user_id}}',
            '{{%address}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-address-user_id}}',
            '{{%address}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-address-user_id}}',
            '{{%address}}'
        );

        $this->dropTable('{{%address}}');
    }
}
