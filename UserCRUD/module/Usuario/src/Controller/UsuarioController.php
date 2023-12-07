<?php

namespace Usuario\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Usuario\Form\UsuarioForm;

class UsuarioController extends AbstractActionController
{
    private $table;

    public function __construct($table)
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

    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id === 0) {
            return $this->redirect()->toRoute('usuario', ['action' => 'adicionar']);
        }

        try {
            $usuario = $this->table->getUsuario($id);
        } catch (\Exception $exc) {
            return $this->redirect()->toRoute('usuario', ['action' => 'index']);
        }

        $form = new UsuarioForm();
        $form->bind($usuario);
        $form->get('submit')->setAttribute('value', 'Salvar');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        $this->table->saveUsuario($form->getData());

        return $this->redirect()->toRoute('usuario');
    }

    public function removerAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('usuario');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del','Não');
            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->deleteUsuario($id);
            }
            return $this->redirect()->toRoute('usuario');
        }
        return ['id' => $id, 'usuario' => $this->table->getUsuario($id)];
    }

}
