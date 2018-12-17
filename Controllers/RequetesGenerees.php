<?php

namespace App\com_zeapps_statistics\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\com_zeapps_statistics\Models\RequeteGeneree as ReqGenModel;

use Zeapps\Core\ModelRequest;

class RequetesGenerees extends Controller
{
    public function context()
    {
        $tabModel = ModelRequest::getRequestContent();

        $modules = array();
        foreach ($tabModel as $dataModule) {
            $std = new \stdClass();
            $std->id = $dataModule['module_id'];
            $std->label = $dataModule['module_name'];
            $modules[] = $std;
        }

        echo json_encode(array(
            'modules' => $modules
        ));
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

    public function getTableFromName(Request $request)
    {
        $argName = $request->input('argName', "");

        $tabModel = ModelRequest::getRequestContent();

        $json = array();

        foreach ($tabModel as $module => $dataModule) {

            $tables = $dataModule["tables"];
            foreach ($tables as $table) {
                if ($table->table == $argName) {
                    $json[] = array("sqlName" => $table->table, "label" => $table->tableLabel, "fields" => array_keys($table->fields));
                    break;
                }
            }
        }

        echo json_encode(array(
            'table' => $json
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

        if (isset($data["id"]) && is_numeric($data["id"]) && $data["id"] > 0) {
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

        echo json_encode($reqGenModel);
    }

    public function execute(Request $request)
    {
        $id = $request->input('id', 0);

        $reqGenModel = ReqGenModel::where('id', $id)->first();

        $std_requete = json_decode($reqGenModel->contenu);


        $requete_finale = null;

        // ************************************** Début construction requête *******************************************

        /**
         * Tables
         */
        if (sizeof($std_requete->tables) == 1) {
            $requete_finale = Capsule::table($std_requete->tables[0]->table);
        } elseif (sizeof($std_requete->tables) > 1) {
            /**
             * Jointures
             */
            if (count($std_requete->jointures)) {

                $requete_finale = Capsule::table($std_requete->jointures[0]->table_left->table);


                foreach ($std_requete->jointures as $jointure) {

                    if ($jointure->type_join == 'LEFT JOIN') {
                        $requete_finale = $requete_finale->leftjoin($jointure->table_right->table, $jointure->table_left->table .'.'. $jointure->field_left->name , "=", $jointure->table_right->table . '.' . $jointure->field_right->name);
                    } elseif ($jointure->type_join == 'RIGHT JOIN') {
                        $requete_finale = $requete_finale->rightjoin($jointure->table_right->table, $jointure->table_left->table .'.'. $jointure->field_left->name , "=", $jointure->table_right->table . '.' . $jointure->field_right->name);
                    } elseif ($jointure->type_join == 'INNER JOIN') {
                        $requete_finale = $requete_finale->join($jointure->table_right->table, $jointure->table_left->table .'.'. $jointure->field_left->name , "=", $jointure->table_right->table . '.' . $jointure->field_right->name);
                    }
                }
            }

        } else {
            // TODO : ERREUR AUCUNE TABLE SELECTIONNEE
            // TODO : ERREUR AUCUNE TABLE SELECTIONNEE
            // TODO : ERREUR AUCUNE TABLE SELECTIONNEE
            // TODO : ERREUR AUCUNE TABLE SELECTIONNEE
            // TODO : ERREUR AUCUNE TABLE SELECTIONNEE
        }

        /**
         * Affichage
         */
        if (count($std_requete->affichages)) {
            $i = 0;

            $arrSelect = array();

            $indexAffichage = 0 ;
            foreach ($std_requete->affichages as &$affichage) {
                $indexAffichage++;
                $affichage->indexAffichage = 'field_req_zeapps_' . $indexAffichage ;

                if ($affichage->operation != "") {
                    $arrSelect[] = Capsule::raw(explode(' ', $affichage->operation)[0] . '(' . $affichage->field . ') as field_req_zeapps_' . $indexAffichage) ;
                } else {
                    $arrSelect[] = $affichage->field . ' as field_req_zeapps_' . $indexAffichage ;
                }
                $i++;
            }

        } else {
            //TODO : ERREUR MAJEURE => ARRET DU SCRIPT
        }

        if ($arrSelect && count($arrSelect)) {
            $requete_finale->select($arrSelect);
        }

        /**
         * Conditions
         */
        if (count($std_requete->conditions)) {
            foreach ($std_requete->conditions as $condition) {
                if (strpos('LIKE', $condition->operation)) {
                    switch ($condition->operation) {
                        case 'LIKE %valeur' :
                            $requete_finale = $requete_finale->where($condition->field, 'like','%' . $condition->value);
                            break;
                        case 'LIKE valeur%' :
                            $requete_finale = $requete_finale->where($condition->field, 'like',$condition->value . '%');
                            break;
                        case 'LIKE %valeur%' :
                            $requete_finale = $requete_finale->where($condition->field, 'like', '%' . $condition->value . '%');
                            break;
                        default :
                            break;
                    }
                } elseif ($condition->operation === 'IN') {
                    $requete_finale = $requete_finale->whereIn($condition->field, is_array($condition->value) ? $condition->value : explode(',', $condition->value));
                } elseif ($condition->operation === 'BETWEEN') {
                    if (is_array($condition->value) && sizeof($condition->value) === 2) {
                        $requete_finale = $requete_finale->whereBetween($condition->field, $condition->value);
                    } elseif (!is_array($condition->value) && sizeof(explode(',', $condition->value)) === 2 )  {
                        $requete_finale = $requete_finale->whereBetween($condition->field, explode(',', $condition->value));
                    }
                }
            }
        }

        /**
         * Group by
         */
        if (count($std_requete->groupsBy)) {
            foreach ($std_requete->groupsBy as $group) {
                $requete_finale = $requete_finale->groupBy($group->field);
            }
        }

        /**
         * Order by
         */
        if (count($std_requete->ordersBy)) {
            foreach ($std_requete->ordersBy as $order) {
                $requete_finale = $requete_finale->orderBy($order->field, $order->sens);
            }
        }

        /**
         * Limit
         */
        if (count($std_requete->limits)) {
            $requete_finale = $requete_finale->limit($std_requete->limits[0]);
        }

        $resultats = $requete_finale->get()->toArray();

        echo json_encode(array('requete' => $std_requete,
            'resultats' => $resultats
        ));


    }

};