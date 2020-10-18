<?php
class Produtos extends Controller {
    function __construct(){
        parent::__construct();
        $this->protect();
    }
    
    public function index(){
        $produtos = $this->model->all();
        
        $this->view->set('produtos', $produtos);  
        $this->view->render('produtos/lista_produtos');
    }

    public function add(){
        $this->view->render('produtos/add_produto');
    }

    public function store(){
        $req = $this->model->store();

        $this->header->status($req ? 200 : 400);
    }

    public function deletar(){
        $this->model->del();
        $this->header->location('./?u=produtos');
    }

    public function autocomplete(){
        $titulo = $_POST['titulo'];
        $buscar = $this->model->findByTitulo($titulo);

        $produtos = [];
        $x = 0;
        while($produto = $buscar->fetch()){
            $produtos[$x]['id'] = $produto['id_produto'];
            $produtos[$x]['titulo'] = $produto['titulo'];
            $produtos[$x]['valor'] = $produto['valor'];
            $x++;
        }

        echo json_encode($produtos);
    }

    public function produto_modal(){
        $id = (int)$_GET['id'];
        $buscar = $this->model->findById($id)->fetch();

        $this->view->set('produto', $buscar);
        $this->view->render('produtos/detalhes_produto.modal', true);
    }

    public function detalhes_modal(){
        $this->view->render('produtos/detalhes.modal', true);
    }
}
?>