<?php
    namespace App\Controllers;

use App\Models\Users;

    class IndexController extends BaseController{
        public function indexAction(){
            if ($_SESSION['perfil'] == "invitado"){
                header("Location: /login");
            }
            
        }
        public function registroAction(){ 
            if(isset ($_POST) && !empty($_POST)){
                $user = Users::getInstancia();
                $user->register($_POST);
                header("Location: /");
            }
            
            $this->renderHTML("../app/Views/registro_view.php");
        }
        public function loginAction(){
            if(isset ($_POST) && !empty($_POST)){
                $user = Users::getInstancia();
                $user->login($_POST);
                header("Location: /");
            }
            $this->renderHTML("../app/Views/login_view.php");
        }
    }
