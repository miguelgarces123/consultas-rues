<?php

namespace MiguelGarces\ConsultasRues\Consultas;


use Goutte\Client;
use MiguelGarces\ConsultasRues\Exceptions\NotFoundToken;
use Symfony\Component\DomCrawler\Field\InputFormField;
use Symfony\Component\DomCrawler\Form;

abstract class ConsultaRues
{

    protected $client;
    protected $token;
    protected $enlace_home = 'https://www.rues.org.co/RM';

    public function __construct() {
        $this->client = new Client();
    }

    /**
     * Funcion para obtener el token necesario en las consultas
     * @author Miguel Garces
     * @return Void
     */
    protected function getToken() : void {
        $crawler = $this->client->request('GET', $this->enlace_home);
        $form = $crawler->filter('#frmLogin')->form()->getValues();
        $token = $form['__RequestVerificationToken'];
        
        if(empty($token)){
            throw new NotFoundToken('No se encontro el token para la petición , talvez lo cambiaron de lugar');
        }
        $this->token = $token;
    }

    /**
     * Funcion para crear formulario para consultas
     * @author Miguel Garces
     * @return Form
     */
    protected function createForm() : Form {
        $domDocument = new \DOMDocument;
        $domElement = $domDocument->createElement('form');
        $domElement->setAttribute('action', $this->enlace);
        $domElement->setAttribute('method', $this->method);
        $form = new Form($domElement, $this->enlace, $this->method);

        // Creacion de input de __RequestVerificationToken
        $domElement = $domDocument->createElement('input');
        $domElement->setAttribute('name', '__RequestVerificationToken');
        $domElement->setAttribute('value', $this->token);
        $formInput = new InputFormField($domElement);
        $form->set($formInput);

        return $form;
    }

}