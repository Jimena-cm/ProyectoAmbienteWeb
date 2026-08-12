<?php
class DisenoController extends Controller {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('');
        }
    }


    public function index() {
        $this->view('diseno/index');
    }
}