<?php
class ClientesModel extends Model {
    function __construct() {
		parent::__construct();
	}

    public function all(){
        $query = $this->db->query("SELECT * FROM clientes ORDER BY id_cliente DESC");
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query;
    }

    public function store(){
        if($_POST['nome'] != '' && $_POST['cpf'] != ''){
            try {
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $endereco = $_POST['endereco'];
                $endereco_num = $_POST['numero'];
                $bairro = $_POST['bairro'];
                $complemento = $_POST['complemento'];
                $cidade = $_POST['cidade'];
                $uf = $_POST['uf'];

                $req = $this->db->prepare("INSERT INTO clientes VALUES (null, :nome, :cpf, :endereco, :num, :bairro, :complemento, :cidade, :uf)");
                $req->execute(array(
                    'nome' => $nome,
                    'cpf' => $cpf,
                    'endereco' => $endereco,
                    'num' => $endereco_num,
                    'bairro' => $bairro,
                    'complemento' => $complemento,
                    'cidade' => $cidade,
                    'uf' => $uf
                ));

                header("HTTP/1.1 200 OK");
                echo 'O cliente foi cadastrado com sucesso!';
                return true;
            } catch (PDOException $err){
                header("HTTP/1.1 400 OK");
                echo 'Não foi possível cadastrar o cliente.';
                return false;
            }
        } else {
            header("HTTP/1.1 400 OK");
            echo 'Parametros não informados.';
            return false;
        }
    }

    public function del(){
        if($_GET['id'] != ''){
            $id = (int)$_GET['id'];

            $req = $this->db->prepare('DELETE FROM clientes WHERE id_cliente = :id');
            $req->execute(array('id' => $id));
        }
    }

    public function findByNome($nome){
        $query = $this->db->query("SELECT * FROM clientes WHERE nome LIKE '%$nome%'");
        $query->setFetchMode(PDO::FETCH_ASSOC);

        return $query;
    }
}
?>