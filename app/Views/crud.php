<?php
// Función para establecer la conexión a la base de datos
function establecerConexion() {
  $host = "127.0.0.1";
  $dbname = "db_registro";
  $user = "postgres";
  $password = "1008";

  $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

  if (!$conn) {
    die("Error al conectar a la base de datos.");
  }

  return $conn;
}

// Función para crear un nuevo usuario en la base de datos
function crearUsuario($usuario, $nombre, $apellido, $correo, $telefono, $fecha) {
  $conn = establecerConexion();

  $query = "INSERT INTO usuarios (usuario, nombre, apellido, correo_electronico, telefono, fecha_registro)
            VALUES ('$usuario', '$nombre', '$apellido', '$correo', '$telefono', '$fecha')";
  
  $result = pg_query($conn, $query);

  if ($result) {
    echo "Usuario creado exitosamente.";
  } else {
    echo "Error al crear el usuario.";
  }

  pg_close($conn);
}

// Función para obtener y mostrar los registros de la base de datos
function obtenerUsuarios() {
  $conn = establecerConexion();

  $query = "SELECT * FROM usuarios";
  $result = pg_query($conn, $query);

  if (!$result) {
    echo "Error al obtener los usuarios.";
  } else {
    while ($row = pg_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['usuario'] . "</td>";
      echo "<td>" . $row['nombre'] . "</td>";
      echo "<td>" . $row['apellido'] . "</td>";
      echo "<td>" . $row['correo_electronico'] . "</td>";
      echo "<td>" . $row['telefono'] . "</td>";
      echo "<td>" . $row['fecha_registro'] . "</td>";
      echo "<td>
        <i class='fas fa-edit edit-icon' onclick='editRow(this)'></i>
        <i class='fas fa-trash delete-icon' onclick='deleteRow(this)'></i>
      </td>";
      echo "</tr>";
    }
  }
 

  pg_close($conn);
}

// Función para editar un usuario en la base de datos
function editarUsuario($usuario, $nombre, $apellido, $correo, $telefono, $fecha) {
  $conn = establecerConexion();

  $query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', correo_electronico='$correo',
            telefono='$telefono', fecha_registro='$fecha' WHERE usuario='$usuario'";
  
  $result = pg_query($conn, $query);

  if ($result) {
    echo "Usuario actualizado exitosamente.";
  } else {
    echo "Error al actualizar el usuario.";
  }

  pg_close($conn);
}

// Función para eliminar un usuario de la base de datos
function eliminarUsuario($usuario) {
  $conn = establecerConexion();

  $query = "DELETE FROM usuarios WHERE usuario='$usuario'";
  
  $result = pg_query($conn, $query);

  if ($result) {
    echo "Usuario eliminado exitosamente.";
  } else {
    echo "Error al eliminar el usuario.";
  }

  pg_close($conn);
}

// Comprobar si se ha enviado una solicitud POST para realizar una operación CRUD
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["operacion"])) {
    $operacion = $_POST["operacion"];

    // Realizar la operación correspondiente según la solicitud
    switch ($operacion) {
      case "crear":
        if (isset($_POST["usuario"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) &&
            isset($_POST["correo"]) && isset($_POST["telefono"]) && isset($_POST["fecha"])) {
          $usuario = $_POST["usuario"];
          $nombre = $_POST["nombre"];
          $apellido = $_POST["apellido"];
          $correo = $_POST["correo"];
          $telefono = $_POST["telefono"];
          $fecha = $_POST["fecha"];

          crearUsuario($usuario, $nombre, $apellido, $correo, $telefono, $fecha);
        }
        break;
      case "editar":
        if (isset($_POST["usuario"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) &&
            isset($_POST["correo"]) && isset($_POST["telefono"]) && isset($_POST["fecha"])) {
          $usuario = $_POST["usuario"];
          $nombre = $_POST["nombre"];
          $apellido = $_POST["apellido"];
          $correo = $_POST["correo"];
          $telefono = $_POST["telefono"];
          $fecha = $_POST["fecha"];

          editarUsuario($usuario, $nombre, $apellido, $correo, $telefono, $fecha);
        }
        break;
      case "eliminar":
        if (isset($_POST["usuario"])) {
          $usuario = $_POST["usuario"];

          eliminarUsuario($usuario);
        }
        break;
    }
  }
}
?>
