<?php
class ProdutosModel extends Model {
    function __construct() {
		parent::__construct();
	}

	public function all(){
		$query = $this->db->query("SELECT * FROM produtos ORDER BY id_produto DESC");
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query;
	}

	public function store(){
		if($_POST['tipo'] != '' && $_POST['titulo'] != ''){
			try {
				$tipo = $_POST['tipo'];
				$titulo = $_POST['titulo'];
				$valor = $_POST['valor'];
				$estoque = $_POST['estoque'];
				$descricao = $_POST['descricao'];
				$caracteristicas = json_encode($_POST['caracteristica']);

				$prep = $this->db->prepare('INSERT INTO produtos VALUES (null, :tipo, :titulo, :descricao, :valor, :caracteristicas, :estoque)');
				$prep->execute(array(
					'tipo' => $tipo,
					'titulo' => $titulo,
					'descricao' => $descricao,
					'valor' => $valor,
					'caracteristicas' => $caracteristicas,
					'estoque' => $estoque
				));

				echo 'O produto foi cadastrado com sucesso!';
				return true;
			} catch (PDOException $err){
                echo 'Não foi possível cadastrar o cliente.';
                return false;
            }
			
			
		}
	}

	public function del(){
		try {
			$id = (int)$_GET['id'];

			$req = $this->db->prepare('DELETE FROM produtos WHERE id_produto = :id');
            $req->execute(array('id' => $id));
		} catch(PDOException $err){
			echo 'Erro ao deletar o produto!';
			return false;
		}
	}

	public function findByTitulo($titulo){
        $query = $this->db->query("SELECT * FROM produtos WHERE titulo LIKE '%$titulo%'");
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query;
	}
	
	public function findById($id){
		$query = $this->db->query("SELECT * FROM produtos WHERE id_produto = $id");
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query;
	}
}
?>