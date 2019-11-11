<?php

use yii\db\Migration;

class m181008_000000_create_tables extends Migration
{
    public function up()
    {
        // TODO: This migration not finished yet


        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'username' => 'demo',
            'email' => 'user@site.com',
            'status' => \app\models\User::STATUS_ACTIVE,
            'auth_key' => '',
            'password_hash' => '',
            'created_at' => (new DateTime())->getTimestamp(),
            'updated_at' => (new DateTime())->getTimestamp(),
        ]);


        $this->createTable('{{%user_prize}}', [
            'id' => $this->primaryKey(),
            'prize_type' => $this->string(),
            'is_received' => $this->boolean()->defaultValue(false),
            'user_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-user_prize-user_id',
            'user_prize',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );


        $this->createTable('{{%money}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->float()->notNull()->defaultValue(50000),
        ]);

        $this->insert('{{%money}}', [
            'amount' => 50000,
        ]);


        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->defaultValue(''),
            'is_reserved' => $this->boolean()->notNull()->defaultValue(false),
        ]);

        for ($i = 1; $i <=10; $i++) {
            $this->insert('{{%product}}', [
                'name' => 'Product ' . $i,
            ]);
        }


        $this->createTable('{{%prize_loyalty}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->float()->notNull()->defaultValue(0),
            'user_prize_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-prize_loyalty-user_prize_id',
            'prize_loyalty',
            'user_prize_id',
            'user_prize',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%prize_money}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->float()->notNull()->defaultValue(0),
            'user_prize_id' => $this->integer(),
            'money_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-prize_money-user_prize_id',
            'prize_money',
            'user_prize_id',
            'user_prize',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-prize_money-money_id',
            'prize_money',
            'money_id',
            'money',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%prize_product}}', [
            'id' => $this->primaryKey(),
            'user_prize_id' => $this->integer(),
            'product_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-prize_product-user_prize_id',
            'prize_product',
            'user_prize_id',
            'user_prize',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-prize_product-product_id',
            'prize_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%money}}');
        $this->dropTable('{{%prize_loyalty}}');
        $this->dropTable('{{%prize_money}}');
        $this->dropTable('{{%prize_product}}');
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%user_prize}}');
    }
}