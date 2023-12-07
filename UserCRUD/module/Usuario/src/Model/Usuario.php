<?php

namespace Usuario\Model;

class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;

    
    public function exchangeArray(array $data)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->nome = isset($data['nome']) ? $data['nome'] : null;
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->senha = isset($data['senha']) ? $data['senha'] : null;
    }

    public function getId(){
        return $this ->id;
    }
    public function getNome(){
        return  $this ->nome;
    }
    public function getEmail(){
        return  $this ->email;
    }
    public function getSenha(){
        return  $this ->senha;
    }

    public function setId($id){
        $this->id = $id;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }


}