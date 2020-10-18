<?php
class PedidosModel extends Model {
    public function all(){
        $query = $this->db->query("SELECT pedidos.*, clientes.nome AS nome_cliente FROM pedidos INNER JOIN clientes ON pedidos.cod_cliente = clientes.id_cliente");
        return $query;
    }

    public function store($params, $produtos){
        try {
            $req = $this->db->prepare("INSERT INTO pedidos VALUES (null, NOW(), :cod_cliente, :valor_total)");
            $req->execute(array(
                'cod_cliente' => $params['cod_cliente'],
                'valor_total' => $params['valor_total']
            ));

            if($req){
                $pedido_id = $this->db->lastInsertId();

                foreach($produtos as $produto){
                    $this->db->query("INSERT INTO pedido_produtos VALUES ($pedido_id, $produto)");
                }

                $this->diminuir_estoque($produtos);
            }

            return true;
        } catch(PDOException $err){
            echo $err;
            return false;
        }
    }

    public function findById($id){
        $query = $this->db->query("SELECT pedidos.*, clientes.nome AS nome_cliente FROM pedidos INNER JOIN clientes ON pedidos.cod_cliente = clientes.id_cliente WHERE id_pedido = '$id'");

        $query_produtos = $this->db->query("SELECT * FROM pedido_produtos INNER JOIN produtos ON pedido_produtos.cod_produto = produtos.id_produto WHERE cod_pedido = '$id'");

        $result = [];
        $result['pedido'] = $query;
        $result['produtos'] = $query_produtos;

        return $result;
    }

    private function diminuir_estoque($array_produtos){
        $cod_produtos = implode(',', $array_produtos);

        $produtos = $this->db->query("SELECT id_produto, estoque FROM produtos WHERE id_produto IN($cod_produtos)")->fetchAll();

        foreach($produtos as $produto){
            $id = $produto['id_produto'];
            $estoque = $produto['estoque'] - 1;
            $this->db->query("UPDATE produtos SET estoque = $estoque WHERE id_produto = $id");
        }
    }
}
?>