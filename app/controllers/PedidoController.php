<?php

class PedidoController extends Controller
{
    private $pedidoModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }

        $this->pedidoModel = $this->model('Pedido');
    }

    public function index()
    {
        $pedidos = $this->pedidoModel->obtenerPorUsuario(
            $_SESSION['user_id']
        );

        $this->view('pedido/index', [
            'pedidos' => $pedidos
        ]);
    }

    public function confirmar()
    {
        $carritoModel = $this->model('Carrito');

        $carrito = $carritoModel->obtener();

        if (empty($carrito)) {
            $this->redirect('carrito');
        }

        $total = $carritoModel->calcularTotal();

        $pedidoId = $this->pedidoModel->crear(
            $_SESSION['user_id'],
            $carrito,
            $total
        );

        if ($pedidoId) {

            $carritoModel->vaciar();

            $_SESSION['pedido_mensaje'] =
                'Tu pedido fue registrado correctamente.';

            $this->redirect('pedido');
        }

        $_SESSION['pedido_error'] =
            'No fue posible registrar el pedido.';

        $this->redirect('carrito');
    }

    public function eliminar($id)
    {
        $this->pedidoModel->eliminar($id);

        $this->redirect('pedido');
    }
}