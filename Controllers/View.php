<?php

namespace App\com_zeapps_statistics\Controllers;

use Zeapps\Core\Controller;

class View extends Controller
{

    ////////////////// REQUETES GENEREES ///////////////////
    ///
    public function view()
    {
        $data = array();
        return view("requetes_generees/view", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

    public function requetesGenereesSearch()
    {
        $data = array();
        return view("requetes_generees/search", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

    public function requeteGenereeRequeteur()
    {
        $data = array();
        return view("requetes_generees/requeteur", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

    public function requetesGenereesFormModalTraitement()
    {
        $data = array();
        return view("requetes_generees/form_modal_traitement", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

}