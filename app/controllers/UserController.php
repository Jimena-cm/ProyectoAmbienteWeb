<?php
require_once '../app/core/Controller.php';
class UserController extends Controller
{
    private $userModel;
    public function __construct()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*
    if (!isset($_SESSION['user_id'])) {
        $this->redirect('/auth/index');
    }
    */

    // Por ahora tampoco cargamos el modelo.
    // $this->userModel = $this->model('User');
}

      //Muestra la lista de usuarios.
   public function index()
{
    $this->view('users/index', [
        'users' => []
    ]);
}
    
      //Muestra el detalle de un usuario.
      public function show($id = null)
{
    $user = [
        'id' => $id ?? 1,
        'name' => 'Alejandro Martínez',
        'email' => 'alejandro@correo.com',
        'phone' => '8888-8888',
        'address' => 'San José'
    ];

    $this->view('users/show', [
        'user' => $user
    ]);
}
    // public function show($id = null)
    // {
    //     if (!$id) {
    //         $this->redirect('/user/index');
    //     }
    //     $user = $this->userModel->getById($id);
    //     if (!$user) {
    //         $this->redirect('/user/index');
    //     }
    //     $this->view('users/show', [
    //         'user' => $user
    //     ]);
    // }
    
     //Crea un usuario.
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'phone' => trim($_POST['phone'] ?? ''),
                'address' => trim($_POST['address'] ?? '')
            ];
            
             //Validación de campos obligatorios.
            if (
                empty($data['name']) ||
                empty($data['email']) ||
                empty($data['password'])
            ) {
                $this->view('users/create', ['error' => 'Nombre, correo y contraseña son obligatorios.','formData' => $data]);
                return;
            }
            
             //Validación del correo.
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->view('users/create', ['error' => 'El correo electrónico no es válido.','formData' => $data]);
                return;
            }
            
             //Verifica que el correo no esté registrado.
            if ($this->userModel->getByEmail($data['email'])) {
                $this->view('users/create', [
                    'error' => 'El correo electrónico ya está registrado.',
                    'formData' => $data
                ]);
                return;
            }
             //Se envía la contraseña al modelo. El modelo debe aplicar password_hash().
            $created = $this->userModel->create($data);
            if ($created) {
                $this->redirect('/user/index');
            }
            $this->view('users/create', ['error' => 'No fue posible crear el usuario.','formData' => $data ]);
            return;
        }
        $this->view('users/create');
    }
        //Edita un usuario existente. 
        public function edit($id = null)
{
    $user = [
        'id' => $id ?? 1,
        'name' => 'Alejandro Martínez',
        'email' => 'alejandro@correo.com',
        'phone' => '8888-8888',
        'address' => 'San José'
    ];

    $this->view('users/edit', [
        'user' => $user
    ]);
}
    // public function edit($id = null)
    // {
    //     if (!$id) { 
    //         $this->redirect('/user/index');
    //     }
    //     $user = $this->userModel->getById($id);
    //     if (!$user) {
    //         $this->redirect('/user/index');
    //     }
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = [
    //             'name' => trim($_POST['name'] ?? ''),
    //             'email' => trim($_POST['email'] ?? ''),
    //             'password' => $_POST['password'] ?? '',
    //             'phone' => trim($_POST['phone'] ?? ''),
    //             'address' => trim($_POST['address'] ?? '')
    //         ];
    //         //En edición, la contraseña es opcional. 
    //         if (
    //             empty($data['name']) ||
    //             empty($data['email'])
    //         ) {
    //             $this->view('users/edit', [
    //                 'user' => array_merge($user, $data),
    //                 'error' => 'El nombre y el correo son obligatorios.'
    //             ]);
    //             return;
    //         }
    //         if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    //             $this->view('users/edit', [
    //                 'user' => array_merge($user, $data),
    //                 'error' => 'El correo electrónico no es válido.'
    //             ]);
    //             return;
    //         }
            
    //         //Verifica que el nuevo correo no pertenezca a otro usuario.
    //         $existingUser = $this->userModel->getByEmail($data['email']);
    //         if (
    //             $existingUser &&
    //             (int) $existingUser['id'] !== (int) $id
    //         ) {
    //             $this->view('users/edit', ['user' => array_merge($user, $data), 'error' => 'El correo ya está en uso por otro usuario.']);
    //             return;
    //         }
    //         $updated = $this->userModel->update($id, $data);
    //         if ($updated) {
    //             $this->redirect('/user/index');
    //         }
    //         $this->view('users/edit', ['user' => array_merge($user, $data), 'error' => 'No fue posible actualizar el usuario.']);
    //         return;
    //     }
    //     $this->view('users/edit', ['user' => $user]);
    // }

        //Elimina un usuario.
    public function delete($id = null)
    {
        if (!$id) {
            $this->redirect('/user/index');
        }

         //Evita que el usuario que inició sesión elimine su propia cuenta.
        if ((int) $id === (int) $_SESSION['user_id']) {
            $this->redirect('/user/index');
        }
        $this->userModel->delete($id);
        $this->redirect('/user/index');
    }
}