<?php

namespace MiguelGarces\ConsultasRues\Consultas;

use MiguelGarces\ConsultasRues\Exceptions\ResponseEmpty;
use MiguelGarces\ConsultasRues\Interfaces\ConsultaRuesByNombreInterface;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\DomCrawler\Field\InputFormField;

class ConsultaRuesByNombre extends ConsultaRues implements ConsultaRuesByNombreInterface 
{
    protected $enlace = 'https://www.rues.org.co/RM/ConsultaNombre_json';
    protected $method = 'POST';
    private $nameField = 'txtNombre';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Funcion para consultar por nombre
     * @author Miguel Garces
     * @param String $nombre Nombre que se desea consultar
     * @return Object
     */
    public function consultar(String $nombre) {

        $this->getToken();

        $form = $this->createForm();
        $this->setInput($form, $nombre);

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
     * @param String $nombre Nombre que se desea consultar
     * @return Void
     */
    private function setInput(Form &$form, String $nombre) : void{
        $domDocument = new \DOMDocument;
        // Creacion de input de nombre
        $domElement = $domDocument->createElement('input');
        $domElement->setAttribute('name', $this->nameField);
        $domElement->setAttribute('value', $nombre);
        $formInput = new InputFormField($domElement);
        $form->set($formInput);
    }

}