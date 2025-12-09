<?php

class m0002_add_password
{
    public function up()
    {
        $db = \app\core\Application::$application->db;
        $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \app\core\Application::$application->db;
        $sql = "ALTER TABLE users DROP COLUMN password";
        $db->pdo->exec($sql);
    }
}