<?php

namespace Usuario\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    private $table;

    public function __construct(UsuarioTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel(['usuarios' => $this->table->getAll()]);
    }

    //Sistema de cadastrado de usuario 
    public function adicionarAction(){
        // Cria um formulário de usuário
        $form = new UsuarioForm();
        $form->get('submit')->setValue('adicionar');

        $request = $this->getRequest();
        // Verifica se a requisição é do tipo POST
        if ($request->isPost()) {
            $form->setData($request->getPost());
            // Verifica se o formulário é válido
            if (!$form->isValid()) {
                return new ViewModel(['form' => $form]);
            }
            // Cria um novo objeto de usuário e preenche com os dados do formulário
            $usuario = new \Usuario\Model\Usuario();
            $usuario->exchangeArray($form->getData());

            // Salva o usuário no banco de dados
            $this->table->saveUsuario($usuario);
           // Redireciona para a rota 'usuario' após a adição bem-sucedida
            return $this->redirect()->toRoute('usuario');
        }   
           // Retorna uma ViewModel com o formulário para exibição inicial
        return new ViewModel(['form' => $form]);
    }

    public function editarAction(){
        return new ViewModel();
    }

    public function removerAction()
    {
        return new ViewModel();
    }

}
