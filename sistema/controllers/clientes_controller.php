<?php
class Clientes extends Controller {

    function __construct(){
        parent::__construct();
        $this->protect();
    }

    public function index(){
        $clientes = $this->model->all();
        
        $this->view->set('clientes', $clientes);   
        $this->view->render('clientes/listar_clientes');
    }

    public function add(){
        $this->view->render('clientes/adicionar');
    }

    public function store(){
        $this->model->store();
    }

    public function deletar(){
        $this->model->del();
        $this->header->location('./?u=clientes');
    }

    public function autocomplete(){
        $nome = $_POST['nome'];
        $buscar = $this->model->findByNome($nome);

        $clientes = [];
        $x = 0;
        while($cliente = $buscar->fetch()){
            $clientes[$x]['id'] = $cliente['id_cliente'];
            $clientes[$x]['nome'] = $cliente['nome'];
            $x++;
        }

        echo json_encode($clientes);
    }
}
?>