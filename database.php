<?php
$mysqli = new mysqli('localhost', 'root', '230913', 'inventario');

if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Crear producto
function crearProducto($nombre, $precio) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
    $stmt->bind_param("sd", $nombre, $precio);
    $stmt->execute();
    $stmt->close();
}

// Leer todos los productos
function obtenerProductos() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombre, precio FROM productos");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Leer producto específico
function obtenerProducto($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT id, nombre, precio FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Actualizar producto
function actualizarProducto($id, $nombre, $precio) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE productos SET nombre = ?, precio = ? WHERE id = ?");
    $stmt->bind_param("sdi", $nombre, $precio, $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar producto
function eliminarProducto($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>