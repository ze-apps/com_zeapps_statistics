<?php

namespace App\com_zeapps_statistics\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;

use App\com_zeapps_statistics\Models\RequeteGeneree as ReqGenModel;

use Zeapps\Core\ModelRequest;

class RequetesGenerees extends Controller
{
    public function context()
    {

    }

    public function getModules()
    {
        $tabModel = ModelRequest::getRequestContent();

        $json = array();

        foreach ($tabModel as $module => $dataModule) {
            $json[] = $module;
        }

        echo json_encode(array(
            'modules' => $json
        ));
    }

    public function getTables(Request $request)
    {
        $argModule = $request->input('argModule', "");
        $withFields = $request->input('argWithFields', false);

        $tabModel = ModelRequest::getRequestContent();

        $json = array();

        foreach ($tabModel as $module => $dataModule) {
            if ($module == $argModule) {
                $tables = $dataModule["tables"];

                foreach ($tables as $table) {
                    if ($withFields == true) {
                        $json[] = array("sqlName" => $table->table, "label" => $table->tableLabel, "fields" => array_keys($table->fields));
                    } else {
                        $json[] = array("sqlName" => $table->table, "label" => $table->tableLabel);
                    }
                }
            }
        }

        echo json_encode(array(
            'tables' => $json
        ));
    }

    public function getFields(Request $request)
    {
        $argModule = $request->input('argModule', "");
        $argTable = $request->input('argTable', "");


        $tabModel = ModelRequest::getRequestContent();


        $json = null;

        foreach ($tabModel as $module => $dataModule) {
            if ($module == $argModule) {
                $tables = $dataModule["tables"];

                foreach ($tables as $table) {
                    if ($table->table == $argTable) {
                        $json = $table->fields ;
                    }
                }
            }
        }

        echo json_encode(array(
            'fields' => $json
        ));
    }

    /*---------------------------
     ----------- CRUD -----------
     ----------------------------*/

    public function getAll(Request $request)
    {
        $filters = array() ;

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $context = $request->input('context', false);

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE)) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $requetes_generees_rs = ReqGenModel::orderBy('id', 'DESC') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $requetes_generees_rs = $requetes_generees_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $requetes_generees_rs = $requetes_generees_rs->where($key, $value) ;
            }
        }

        $total = $requetes_generees_rs->count();
        $requetes_generees_rs_id = $requetes_generees_rs ;

        $requetes_generees = $requetes_generees_rs->limit($limit)->offset($offset)->get();

        if(!$requetes_generees) {
            $requetes_generees = array();
        }


        $ids = [];
        if($total < 500) {
            $rows = $requetes_generees_rs_id->select(array("id"))->get();
            foreach ($rows as $row) {
                array_push($ids, $row->id);
            }
        }

        echo json_encode(array(
            'requetes_generees' => $requetes_generees,
            'total' => $total,
            'ids' => $ids
        ));
    }

    public function search()
    {
        $requests = ReqGenModel::all();

        echo json_encode(array('requetes_generees' => $requests));
    }

    public function save()
    {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $ReqGenModel = new ReqGenModel() ;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $ReqGenModel = ReqGenModel::where('id', $data["id"])->first() ;
        }

        foreach ($data as $key => $value) {

            if ($key == 'nom_requete' && trim($value) == '') {
                $value = 'Sans nom';
            }

            if ($key == 'contenu') {
                $value = json_encode($value);
            }

            $ReqGenModel->$key = $value ;
        }

        $ReqGenModel->save();

        echo $ReqGenModel->id;
    }

    public function get(Request $request)
    {
        $id = $request->input('id', 0);

        $reqGenModel = ReqGenModel::where('id', $id)->first();

        if (!$reqGenModel) {
            $reqGenModel = [];
        }

        echo json_encode(array(
            'reqGenModel' => $reqGenModel
        ));
    }


    public function execute(Request $request)
    {
        $id = $request->input('id', 0);

        $reqGenModel = ReqGenModel::where('id', $id)->first();

        $std_requete = json_decode($reqGenModel->contenu);

        // array de plusieurs arrays
        $tables = $std_requete->tables;
        /*
         ["tables"]=>
              array(2) {
                [0]=>
                string(35) "com_zeapps_contact_account_families"
                [1]=>
                string(37) "com_zeapps_contact_accounting_numbers"
              }
         * */

        $jointures = $std_requete->jointures;
        /*
         ["jointures"]=>
              array(2) {
                [0]=>
                object(stdClass)#138 (5) {
                  ["table_left"]=>
                  string(35) "com_zeapps_contact_account_families"
                  ["table_right"]=>
                  string(37) "com_zeapps_contact_accounting_numbers"
                  ["type_join"]=>
                  string(9) "FULL JOIN"
                  ["field_left"]=>
                  string(5) "label"
                  ["field_right"]=>
                  string(6) "number"
                }
                [1]=>
                object(stdClass)#139 (5) {
                  ["table_left"]=>
                  string(35) "com_zeapps_contact_account_families"
                  ["table_right"]=>
                  string(37) "com_zeapps_contact_accounting_numbers"
                  ["type_join"]=>
                  string(9) "LEFT JOIN"
                  ["field_left"]=>
                  string(4) "sort"
                  ["field_right"]=>
                  string(10) "type_label"
                }
              }
         * */


        $affichage = $std_requete->affichage;
        /*
        ["affichage"]=>
          array(3) {
            [0]=>
            object(stdClass)#143 (2) {
              ["field"]=>
              string(41) "com_zeapps_contact_account_families.label"
              ["operation"]=>
              string(9) "COUNT ( )"
            }
            [1]=>
            object(stdClass)#145 (2) {
              ["field"]=>
              string(44) "com_zeapps_contact_accounting_numbers.number"
              ["operation"]=>
              string(0) ""
            }
            [2]=>
            object(stdClass)#140 (2) {
              ["field"]=>
              string(48) "com_zeapps_contact_accounting_numbers.type_label"
              ["operation"]=>
              string(0) ""
            }
          }
         * */

        $conditions = $std_requete->conditions;
        /*
         ["conditions"]=>
          array(2) {
            [0]=>
            object(stdClass)#147 (3) {
              ["field"]=>
              string(41) "com_zeapps_contact_account_families.label"
              ["operation"]=>
              string(1) "="
              ["value"]=>
              string(4) "toto"
            }
            [1]=>
            object(stdClass)#146 (3) {
              ["field"]=>
              string(44) "com_zeapps_contact_accounting_numbers.number"
              ["operation"]=>
              string(2) ">="
              ["value"]=>
              string(4) "5000"
            }
          }
         * */

        $groupsby = $std_requete->groupsby;
        $ordersby = $std_requete->ordersby;
        $limit = $std_requete->limit;
        $pagination = $std_requete->pagination;

        /*
         ["groupsby"]=>
              array(1) {
                [0]=>
                object(stdClass)#144 (1) {
                  ["field"]=>
                  string(43) "com_zeapps_contact_accounting_numbers.label"
                }
              }
          ["ordersby"]=>
              array(1) {
                [0]=>
                object(stdClass)#125 (2) {
                  ["field"]=>
                  string(44) "com_zeapps_contact_accounting_numbers.number"
                  ["sens"]=>
                  string(4) "DESC"
                }
              }
          ["limit"]=>
              array(1) {
                [0]=>
                string(2) "50"
              }
          ["pagination"]=>
              array(1) {
                [0]=>
                string(3) "Non"
              }
         * */

        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete
        // TODO : Construction dynamique de la requete

        var_dump($std_requete);
        exit();

        // Exemple
        $results = ReqGenModel::select('nom_requete', 'contenu')
            ->where('id', '=', $id)
            ->get()->toArray();

        var_dump($results);
        exit();

        $requeteResultats = array(
            'nom_requete' => 'nom de la requete',
            'contenu' => 'contenu de la reqyete (SQL)',
            'created_at' => 'crée le : xx/xx/yyyy'
        );

        echo json_encode(array(
            'requeteResultats' => $requeteResultats
        ));


    }
};