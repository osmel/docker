<?php
        $user = "osmel";
        $pass = "contrasena";
        $host = "mariadb";
        $db = "base_dato";
        $charset = 'utf8mb4';

   $options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
     $pdo = new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
} 
        // make query
        $query = "SELECT * FROM tabla";
        $stmt = $pdo->query( $query ) or die ( "error en la consulta");

        //show data
        // header table
        echo "<table borde='2'>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>Nombre</th>";
        echo "</tr>";

        // Bucle while for each registry
        while ($columna = $stmt->fetch())
        {
                echo "<tr>";
                echo "<td>" . $columna['id'] . "</td><td>" . $columna['nombre'] . "</td>";
                echo "</tr>";
        }

        echo "</table>"; // end table
        // close database
 //     mysqli_close( $conexion );
?>

