<?php
class Carrito
{
    public function obtener()
    {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
        return $_SESSION['carrito'];
    }

    public function agregar($producto)
    {
        $id = $producto['id'];

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'precio' => $producto['precio'],
                'imagen_nombre' => $producto['imagen_nombre'],
                'material' => $producto['material'],
                'tamano' => $producto['tamano'],
                'cantidad' => 1
            ];
        }
    }

    public function aumentar($id)
    {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        }
    }

    public function disminuir($id)
    {
        if (isset($_SESSION['carrito'][$id])) {

            if ($_SESSION['carrito'][$id]['cantidad'] > 1) {
                $_SESSION['carrito'][$id]['cantidad']--;
            } else {
                unset($_SESSION['carrito'][$id]);
            }
        }
    }

    public function eliminar($id)
    {
        if (isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
    }

    public function calcularTotal()
    {
        $total = 0;
        if (!isset($_SESSION['carrito'])) {
            return $total;
        }
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        return $total;
    }

    public function vaciar()
    {
        $_SESSION['carrito'] = [];
    }
}