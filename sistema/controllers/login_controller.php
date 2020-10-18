<?php
class Login extends Controller {
    function __construct(){
        parent::__construct();
    }

    public function index(){
        if($_POST['login'] != '' && $_POST['senha'] != ''){
            $login = $_POST['login'];
            $senha = sha1($_POST['senha']);

            if($login == 'ifpa' && $senha == '0647e0d87c70421bb314c5e58cc3fb7b035044d9'){
                Session::init();
                Session::set('loggedIn', true);

                header("Location: ./?u=pedidos");
                exit;
            } else {
                $this->view->set('loginInvalido', true);
            }
        }
        $this->view->render('login', true);
    }

    public function sair(){
        Session::destroy();
        header("Location: ./");
    }
}
?>