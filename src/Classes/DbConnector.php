<?php

class DbConnector
{
    private static PDO $db;
    const HOST = 'db';
    const DB = 'iofarm';
    const USER = 'root';
    const PASSWORD = 'password';

    const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    public static function connectToDb(): PDO
    {
        if (empty(self::$db)) {
            self::$db = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB . ';', self::USER, self::PASSWORD, self::OPTIONS);
        }
        return self::$db;
    }
}

$pdo = DbConnector::connectToDb();

$query = $pdo->prepare('SELECT * FROM `pigs`;');

// 3. Execute the query

$query->execute();

$pigs = $query->fetchAll();

/*echo '<pre>';
print_r($pigs);
echo '</pre>';*/

echo '<ul>';
foreach ($pigs as $pig) {
    echo '<li>' . $pig['name'] . '-' . $pig['color'] . '</li>';
}
echo '</ul>';
