<?php
class Pedidos extends Controller {
    function __construct(){
        parent::__construct();
        $this->protect();
    }
    
    public function index(){
        $all = $this->model->all();
        $this->view->set('pedidos', $all);
        $this->view->render('pedidos/lista_pedidos');
    }

    public function add(){
        $this->view->render('pedidos/add_pedido');
    }

    public function store(){
        $params = [];
        $params['cod_cliente'] = $_POST['cod_cliente'];
        $params['valor_total'] = $_POST['valor_total'];
        
        $produtos = $_POST['cod_produto'];
        
        $req = $this->model->store($params, $produtos);
        
        if($req){
            echo 'O pedido foi finalizado com sucesso!';
            $this->header->status(200);
        } else {
            echo 'Erro ao finalizar o pedido!';
            $this->header->status(400);
        }
    }

    public function modal_pedido(){
        $id = (int)$_GET['id'];
        $req = $this->model->findById($id);
        $this->view->set('pedido', $req['pedido']);
        $this->view->set('produtos', $req['produtos']);
        $this->view->render('pedidos/ver_pedido.modal', true);
    }
}
?>