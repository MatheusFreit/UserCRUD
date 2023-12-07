<<?php 

namespace Usuario\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}

