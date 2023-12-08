<?php 

namespace Usuario\Model;

use Laminas\Db\tableGateway\tableGatewayInterface;

use RuntimeException;

class UsuarioTable{

    private $tableGateway;

    public function __construct (tableGatewayInterface $tableGateway){
         // Inicializa o TableGateway para interação com o banco de dados
        $this->tableGateway = $tableGateway;

    }

 // Obtém todos os registros da tabela
    public function getAll(){
        try {
            
            $resultSet = $this->tableGateway->select();
            // Retorna o conjunto de resultados
            return $resultSet;
        } catch (\Exception $e) {
            // Adicione uma mensagem de erro se ocorrer uma exceção
            echo "Erro ao obter todos os usuários: " . $e->getMessage();
            // Retorna um array vazio
            return [];
        }

    }

 // Obtém um usuário específico com base no ID
    public function getUsuario($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(["id" => $id]);
        $row = $rowset -> current();
         // Lança uma exceção se o usuário não for encontrado
        if(!$row){
            throw new RuntimeException(sprintf('Não foi encontrado o id %d', $id));
        }
        return $row; 
    }

    public function getUsuarionome($nome){
        
        $rowset = $this->tableGateway->select(["nome" => $nome]);
        $row = $rowset -> current();
         // Lança uma exceção se o usuário não for encontrado
        if(!$row){
            throw new RuntimeException(sprintf('Não foi encontrado o id %d', $id));
        }
        return $row; 
    }

    public function saveUsuario(Usuario $usuario)
    {
        $data = [
            'id' => $usuario ->getId(),
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
        ];

        $id = (int) $usuario->getId();
        // Insere um novo usuário se o ID for 0
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        } else {
             // Atualiza o usuário se o ID já existir
            if ($this->getUsuario($id)) {
                $this->tableGateway->update($data, ['id' => $id]);
            // Lança uma exceção se o usuário não existir 
            } else {
                throw new RuntimeException("Usuário de ID $id não encontrado.");
            }
        }
    }

    public function deleteUsuario($id)
    {   // Exclui um usuário com base no ID
        $this->tableGateway->delete(['id' => (int) $id]);
    }

}