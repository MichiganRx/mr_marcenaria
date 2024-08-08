<?php
class FiltroProduto
{
    public $conn;

    public function __construct()
    {
        $db = new banco();
        $this->conn = $db->conn;
    }

    public function filtrarProdutos($filtro)
    {
        $filtro = $this->conn->real_escape_string($filtro);
        $sql = "SELECT * FROM produto WHERE nomeproduto LIKE '%" . $filtro . "%'";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }
}
class produto
{
    public $conn;
    public function __construct()
    {
        $db = new banco;
        $this->conn = $db->conn;
    }

    public function cadastrar($inputData)
    {
        $produto = $inputData['produto'];
        $saldo = $inputData['saldo'];
        $minimo = $inputData['minimo'];
        $estoque = $inputData['idestoque'];
        $fornecedor = $inputData['idfornecedor'];
        $sql = "INSERT INTO produto (nomeproduto,saldo,quantidade_minima,idestoque,idfornecedor) VALUES 
        ('" . $produto . "','" . $saldo . "','" . $minimo . "','".$estoque."','".$fornecedor."')";
        $result = $this->conn->query($sql);

        if ($result == 1) {
            //echo "ok";
            return true;
        } else {
            //echo "nok";
            return false;
        }
    }

    public function excluir_produto($id, $acao)
    {
        if ($acao == 1) {
            $sql = "DELETE FROM `mr_marcenaria`.`produto` WHERE (`idproduto` = '" . $id . "') limit 1";
            $resultado = $this->conn->query($sql);
            $resultado = $this->conn->affected_rows;
            return $resultado;
        }
    }

    public function listar_produtos()
    {
        $sql = "SELECT * FROM produto";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }

    public function buscar_um_produto($nome)
    {
        $xpto = "select * from produto where nomeproduto like '%" . $nome . "%'";
        $dados = $this->conn->query($xpto);
        return $dados;
    }

    public function estoque()
    {
        $xpto = "select * from produto where saldo < quantidade_minima";
        $dados = $this->conn->query($xpto);
        return $dados;
    }

    public function editar_produto($inputData, $acao)
    {
        $idproduto = $inputData['idproduto'];
        $produto = $inputData['nomeproduto'];
        $saldo = $inputData['saldo'];
        $minimo = $inputData['minimo'];
        $estoque = $inputData['idestoque'];
        $fornecedor = $inputData['idfornecedores'];


        if ($acao == 1) {
            $sql = "UPDATE `mr_marcenaria`.`produto` SET `nomeproduto` = '" . $produto . "', `saldo` = '" . $saldo . "', 
            `quantidade_minima` = '" . $minimo . "', `idestoque` = '". $estoque . "', `idfornecedor` = '". $fornecedor . "' WHERE `idproduto` = '" . $idproduto . "' limit 1";
            $result = $this->conn->query($sql);
            $result = $this->conn->query($sql);
            if ($result == 1) {
                //echo "ok";
                return true;
            } else {
                //echo "nok";
                return false;
            }
        }
    }

    public function listar_produto($id, $acao)
    {

        if ($acao == 1) {
            $sql = "select * from produto where idproduto= '$id'";
            $resultado = $this->conn->query($sql);
            //$linha = $resultado->fetch_array();
            //return $linha;
            return $resultado;
        }
    }
}


class funcionario {
    public function validar($data) {
        $db = new banco;
        $login = $data['login'];
        $senha = $data['senha'];
        $sql = "SELECT COUNT(*) as count FROM usuario WHERE login='$login' AND senha='$senha'";
        $result = $db->conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function criar($data) {
        $db = new banco;
        $nome = $data['nome'];
        $login = $data['login'];
        $senha = $data['senha'];
        $idcargo = $data['idcargo'];

        $sql = "INSERT INTO usuario (nome, login, senha, idcargo) VALUES ('$nome', '$login', '$senha', '$idcargo')";
        return $db->conn->query($sql);
    }
}

class fornecedores
{
    public $conn;

    public function __construct()
    {
        $db = new banco;
        $this->conn = $db->conn;
    }

    public function cadastrar_fornecedor($lista)
    {
        $nome = $lista['nomefornecedor'];
        $telefone = $lista['telefone'];
        $tipo = $lista['tipoforn'];

        $sql = "INSERT INTO `fornecedores` (`nomefornecedor`, `tipofornecedor`, `telefone`) 
                VALUES ('$nome', '$tipo', '$telefone')";

        $resultado = $this->conn->query($sql);

        if (!$resultado) {
            error_log("Erro ao inserir fornecedor: " . $this->conn->error);
        }

        return $resultado;
    }

    public function listar_fornecedor()
    {
        $sql = "SELECT * FROM fornecedores";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }
}

class cargo
{
    public $conn;
    public function __construct()
    {
        $db = new banco;
        $this->conn = $db->conn;
    }

    public function cadastrar_cargo($lista)
    {
        $cargo = $lista['cargo'];
        $sql = "INSERT INTO `mr_marcenaria`.`cargo` (`cargo`) 
        VALUES ('" . $cargo . "');
        ";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }

    public function listar_cargos()
    {
        $sql = "select * from cargo order by cargo asc";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }
}
class tipo
{
    public $conn;
    public function __construct()
    {
        $db = new banco;
        $this->conn = $db->conn;
    }

    public function cadastrar_tipo($lista)
    {
        $tipo = $lista['tipo'];
        $sql = "INSERT INTO `mr_marcenaria`.`tipo` (`tipo`) 
        VALUES ('" . $tipo . "');
        ";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }

    public function listar_tipos()
    {
        $sql = "select * from tipo order by tipo asc";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }
}

class estoque {
    public $conn;
    public function __construct()
    {
        $db = new banco;
        $this->conn = $db->conn;
    }

    public function listar_estoques()
    {
        $sql = "select * from estoque order by estoque asc";
        $resultado = $this->conn->query($sql);
        return $resultado;
    }
}
