<?php

class PedidoController extends Controller
{
    private $pedidoModel;
    private $carritoModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->pedidoModel = $this->model('Pedido');
        $this->carritoModel = $this->model('Carrito');
    }

    public function confirmar()
    {
        $carrito = $this->carritoModel->obtener();

        if (empty($carrito)) {
            $this->redirect('carrito');
        }

        $total = $this->carritoModel->calcularTotal();

        $pedidoId = $this->pedidoModel->crear(
            $_SESSION['user_id'],
            $carrito,
            $total
        );

        if ($pedidoId) {

            $this->carritoModel->vaciar();

            $_SESSION['pedido_mensaje'] =
                'Tu pedido fue registrado correctamente.';

            $this->redirect('pedido/historial');
        }

        $_SESSION['pedido_error'] =
            'No fue posible registrar el pedido.';

        $this->redirect('carrito');
    }

    public function historial()
    {
        $pedidos = $this->pedidoModel->obtenerPorUsuario(
            $_SESSION['user_id']
        );

        $this->view('pedido/historial', [
            'pedidos' => $pedidos
        ]);
    }
}