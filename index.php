<?php
require 'database.php';

// Manejo de solicitudes POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        if (!empty($_POST["nombre"]) && !empty($_POST["precio"])) {
            crearProducto($_POST["nombre"], $_POST["precio"]);
        } else {
            echo "<script>alert('Nombre y precio son requeridos');</script>";
        }
    } elseif (isset($_POST["actualizar"])) {
        if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["precio"])) {
            actualizarProducto($_POST["id"], $_POST["nombre"], $_POST["precio"]);
        } else {
            echo "<script>alert('ID, nombre y precio son requeridos');</script>";
        }
    } elseif (isset($_POST["eliminar"])) {
        if (!empty($_POST["id"])) {
            eliminarProducto($_POST["id"]);
        } else {
            echo "<script>alert('ID es requerido');</script>";
        }
    }
}

// Obtener lista de productos
$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercería Los Hilos - Administración de Productos</title>
    <style>
        /* Estilos de la página */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #b06bbd;
            padding: 15px;
            text-align: center;
            color: #ffffff;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #7d4788;
            padding: 10px 0;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .section {
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #b06bbd;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <header>
        <h1>Mercería Los Hilos - Administración de Productos</h1>
    </header>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Formulario para agregar producto -->
        <section class="section">
            <h2>Agregar Producto</h2>
            <form method="POST" action="">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" required>
                <button type="submit" name="crear">Crear</button>
            </form>
        </section>

        <!-- Formulario para actualizar producto -->
        <section class="section">
            <h2>Actualizar Producto</h2>
            <form method="POST" action="">
                <label>ID:</label>
                <input type="number" name="id" required>
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
                <label>Precio:</label>
                <input type="number" step="0.01" name="precio" required>
                <button type="submit" name="actualizar">Actualizar</button>
            </form>
        </section>

        <!-- Formulario para eliminar producto -->
        <section class="section">
            <h2>Eliminar Producto</h2>
            <form method="POST" action="">
                <label>ID:</label>
                <input type="number" name="id" required>
                <button type="submit" name="eliminar">Eliminar</button>
            </form>
        </section>

        <!-- Lista de productos -->
        <section class="section">
            <h2>Lista de Productos</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                </tr>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto["id"]); ?></td>
                    <td><?php echo htmlspecialchars($producto["nombre"]); ?></td>
                    <td><?php echo htmlspecialchars(number_format($producto["precio"], 2)); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </div>
</body>
</html>