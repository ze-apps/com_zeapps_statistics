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
        return view("requetes_generees/result_request", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

    public function requetesGenereesSearch()
    {
        $data = array();
        return view("requetes_generees/search", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

    public function requeteGenereeView()
    {
        $data = array();
        return view("requetes_generees/view", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

    public function requeteGenereeNew()
    {
        $data = array();
        return view("requetes_generees/new", $data, BASEPATH . 'App/com_zeapps_statistics/views/');
    }

}