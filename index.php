<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Hello World!</title>
    </head>
    <body>
        <img src="http://blog.osteel.me/images/2015/12/18/docker-tutorial2.gif" alt="Hello World!" />
        <?php
        $database   = $user = $password = "project";
        $host       = "mysql";
        $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
        $query      = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_TYPE='BASE TABLE'");
        $tables     = $query->fetchAll(PDO::FETCH_COLUMN);

        if (empty($tables)) {
            echo "<p>There are no tables in database \"{$database}\".</p>";
        } else {
            echo "<p>Database \"{$database}\" has the following tables:</p>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo "</ul>";
        }
        ?>
    </body>
</html>