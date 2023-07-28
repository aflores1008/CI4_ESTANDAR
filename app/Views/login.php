<!DOCTYPE html>
<?php include 'crud.php'; ?>

<html>

<head>
  <title>Registro de Usuarios</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    form {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 40px;
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Estilos para los iconos */
    .edit-icon {
      color: blue;
      cursor: pointer;
      margin-right: 5px;
    }

    .delete-icon {
      color: red;
      cursor: pointer;
    }
  </style>

  <!-- Incluir la biblioteca Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <h1>Registro de Usuarios</h1>
  <form id="userForm">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required>

    <label for="correo">Correo Electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" required>

    <label for="fecha">Fecha de Registro:</label>
    <input type="date" id="fecha" name="fecha" required>

    <input type="submit" value="Guardar">
   
  </form>


  <h2 class="results-title">Resultados:</h2>
  <table id="userTable">
    <tr>
      <th>Usuario</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Correo Electrónico</th>
      <th>Teléfono</th>
      <th>Fecha de Registro</th>
      <th>Acciones</th>
    </tr>
    <?php  obtenerUsuarios(); ?>
  </table>

  <script>
    // Obtener referencias a los elementos del formulario y la tabla
    const form = document.getElementById('userForm');
    const table = document.getElementById('userTable');

    // Manejador de eventos para el envío del formulario
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Evita el envío del formulario por defecto

      // Obtener los valores de los campos del formulario
      const usuario = document.getElementById('usuario').value;
      const nombre = document.getElementById('nombre').value;
      const apellido = document.getElementById('apellido').value;
      const correo = document.getElementById('correo').value;
      const telefono = document.getElementById('telefono').value;
      const fecha = document.getElementById('fecha').value;

      // Crear una nueva fila en la tabla con los valores del formulario
      const newRow = table.insertRow(-1);
      newRow.innerHTML = `
        <td>${usuario}</td>
        <td>${nombre}</td>
        <td>${apellido}</td>
        <td>${correo}</td>
        <td>${telefono}</td>
        <td>${fecha}</td>
        <td>
          <i class="fas fa-edit edit-icon" onclick="editRow(this)"></i>
          <i class="fas fa-trash delete-icon" onclick="deleteRow(this)"></i>
        </td>
      `;

      // Limpiar los valores del formulario
      form.reset();
    });

    // Función para editar una fila de la tabla
    function editRow(button) {
      const row = button.parentNode.parentNode;
      const cells = row.getElementsByTagName('td');

      // Obtener los valores de la fila seleccionada
      const usuario = cells[0].innerText;
      const nombre = cells[1].innerText;
      const apellido = cells[2].innerText;
      const correo = cells[3].innerText;
      const telefono = cells[4].innerText;
      const fecha = cells[5].innerText;

      // Actualizar los valores del formulario con los valores de la fila seleccionada
      document.getElementById('usuario').value = usuario;
      document.getElementById('nombre').value = nombre;
      document.getElementById('apellido').value = apellido;
      document.getElementById('correo').value = correo;
      document.getElementById('telefono').value = telefono;
      document.getElementById('fecha').value = fecha;

      // Eliminar la fila seleccionada
      row.remove();
    }

    // Función para eliminar una fila de la tabla
    function deleteRow(button) {
      const row = button.parentNode.parentNode;
      row.remove();
    }
  </script>
</body>
</html>