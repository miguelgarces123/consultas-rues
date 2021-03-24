<?php

namespace MiguelGarces\ConsultasRues\Consultas;

use MiguelGarces\ConsultasRues\Exceptions\ResponseEmpty;
use MiguelGarces\ConsultasRues\Interfaces\ConsultaRuesByNitInterface;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\DomCrawler\Field\InputFormField;

class ConsultaRuesByNit extends ConsultaRues implements ConsultaRuesByNitInterface 
{
    protected $enlace = 'https://www.rues.org.co/RM/ConsultaNIT_json';
    protected $method = 'POST';
    private $nameField = 'txtNIT';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Funcion para consultar por nit
     * @author Miguel Garces
     * @param Int $nit Nit que se desea consultar
     * @return Object
     */
    public function consultar(Int $nit) {

        $this->getToken();

        $form = $this->createForm();
        $this->setInput($form, $nit);

        $this->client->submit($form);

        $res = $this->client->getInternalResponse()->getContent();

        if(!empty($res)){
            return json_decode($res);
        }

        throw new ResponseEmpty('Respuesta vacia', $res);
    }


    /**
     * Funcion crear input de consulta a RUES
     * @author Miguel Garces
     * @param Form $form Formulario preconstruido
     * @param Int $nit Nit que se desea consultar
     * @return Void
     */
    private function setInput(Form &$form, Int $nit) : void{
        $domDocument = new \DOMDocument;
        // Creacion de input de nit
        $domElement = $domDocument->createElement('input');
        $domElement->setAttribute('name', $this->nameField);
        $domElement->setAttribute('value', $nit);
        $formInput = new InputFormField($domElement);
        $form->set($formInput);
    }

}