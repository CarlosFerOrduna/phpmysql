<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Insertar datos</title>
    </head>
    <body style="text-align: center">
        <div>
            <form action="index.php" method="post">
                <input type="text" name="texto" id="texto">
                <input type="submit" value="Añadir pendiente">
            </form>
        </div>
        <div>
            <form id="mostrar" action="index.php" method="post" >
                <input type="checkbox" name="mostrar" onchange="mostrarTodo(this)">
                <label>Mostrar todo</label>
            </form>
        </div>
        <div id="todolist">
            <?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $db = "todolist";

            $conection = new mysqli($server, $username, $password, $db);

            if ($conection->connect_error) {
                die("Conexion fallida: " . $conection->connect_error);
            }

            if (isset($_POST['texto'])) {
                $texto = $_POST['texto'];

                if ($texto != "") {
                    $sql = "INSERT INTO todotable(texto,completo) values ('$texto',false)";
                    if ($conection->query($sql) === true) {
                        //  echo '<div><form action=""><input type="checkbox" name="" id="">' . $texto . '</form></div>';
                    } else {
                        die("Conexion fallida" . $conection->error);
                    }
                }
            } else if (isset($_POST['completar'])) {
                $id = $_POST['completar'];

                $sql = "UPDATE todotable SET completo = 1 WHERE id = '$id'";

                $conection->query($sql);
            } else if (isset($_POST['eliminar'])) {
                $id = $_POST['eliminar'];

                $sql = "DELETE FROM todotable WHERE id = '$id'";

                $conection->query($sql);
            }

            if (isset($_POST['mostrar'])) {
                $mostrar = $_POST['mostrar'];

                if ($mostrar == "on") {
                    $sql = "SELECT * FROM todotable ORDER BY completo DESC";
                }
            } else {
                $sql = "SELECT * FROM todotable WHERE completo = 0";
            }
            $resultado = $conection->query($sql);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    ?>
                    <div>
                        <form method="post" id="<?php echo $row['id']; ?>" action="index.php">
                            <input name ="completar" value="<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>" type="checkbox" onchange="completarPendiente(this)" <?php if($row['completo'] == 1 )echo "checked disabled"; ?>><?php echo $row['texto']; ?>
                        </form>
                        <form method="post" id="eliminar_<?php echo $row['id']; ?>" action="index.php">
                            <input type="hidden" name="eliminar" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </div>
                    <?php
                }
            }

            $conection->close();
            ?>
        </div>
        <script>
            function completarPendiente(e) {
                var id = e.id;
                var formulario = document.getElementById(id);
                formulario.submit();
            }
            function mostrarTodo(e) {
                var formulario = document.getElementById("mostrar");
                formulario.submit();
            }
        </script>
    </body>
</html>