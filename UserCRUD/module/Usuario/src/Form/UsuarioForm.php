<?php
namespace Usuario\Form;

use Laminas\Form\Form;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Password;

class UsuarioForm extends Form {

    public function __construct(){
        parent::__construct('usuario',[]);

        $this->add(new Hidden('id'));
        $this->add(new Text("nome",['label' => "Nome"]));
        $this->add(new Email("email",['label' => "Email"]));
        $this->add(new Password("senha",['label' => "Senha"]));
        
        $submit = new Submit ('submit');
        $submit->setAttributes(['value'=>'Salvar','id'=>'submitbutton']);
        $this->add($submit);

    }

}