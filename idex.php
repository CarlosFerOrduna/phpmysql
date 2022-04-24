<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Insertar datos</title>
</head>
<body>
<form action="idex.php" method="post">
    <input type="text" name="texto" id="texto">
    <input type="submit" value="añadir pendiente">
</form>
    <div id="todolist">
        <?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $db = "todolist";

        $conection = new mysqli($server,$username,$password,$db);

        if($conection->connect_error){
            die("Conexion fallida: " . $conection->connect_error);
        }

        if (isset($_POST['texto'])){
            $texto = $_POST['texto'];

            $sql = "INSERT INTO todotable(texto,completo) values ($texto,false)";

            if($conection.->query($sql) === true){
                echo '<div><form action=""><input type="checkbox" name="" id="">'.$texto.'</form></div>';
            }else{
                die("Conexion fallida" . $conection->error);
            }
        }

        $sql = "SELECT * FROM todotable";
        $resultado = $conection->query($sql);

        if($resultado->num_rows > 0){
            while ($row = $resultado->fetch_assoc()){
                echo '<div><form action=""><input type="checkbox" name="" id="">' . $row['texto'] . '</form></div>';
            }
        }
        $conection->close();

        ?>
    </div>
</body>
</html>

