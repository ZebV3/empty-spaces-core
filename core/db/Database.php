<?php

namespace app\core\db;

use app\core\Application;
use PDO;

/**
 * Class Database
 * 
 * @author Shahzaib Hassan <shahzaibhassan1578.dev@gmail.com>
 * @package app\core
 */

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function apply_migrations()
    {
        $this->create_migrations_table();
        $applied_migrations = $this->get_applied_migrations();

        $new_migrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $migrations_to_be_applied = array_diff($files, $applied_migrations);

        foreach ($migrations_to_be_applied as $migration) {
            if ($migration === '.' || $migration === '..')
                continue;

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $class_name = pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $class_name();
            $this->log("Applying migration for $migration");
            $instance->up();
            $this->log("Migration for $migration done");

            $new_migrations[] = $migration;
        }

        if (!empty($new_migrations)) {
            $this->save_migrations($new_migrations);
        } else {
            $this->log("All migrations all applied");
        }
    }

    public function create_migrations_table()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function get_applied_migrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function save_migrations(array $migrations)
    {
        $migration_values = implode(',', array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migration_values");
        $statement->execute();
    }

    public function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }

    public function prepare($sql)
    {
        return Application::$application->db->pdo->prepare($sql);
    }
}