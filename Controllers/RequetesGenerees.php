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

        var_dump($reqGenModel);
        exit();

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

        $requete_finale = null;

        // ************************************** Début construction requête *******************************************

        /**
         * Tables
         */
        if (count($std_requete->tables)) {
            $requete_finale = Capsule::table($std_requete->tables[0]);
        } else {
            //TODO : ERREUR MAJEURE => ARRET DU SCRIPT
        }

        /**
         * Jointures
         */
        if (count($std_requete->jointures)) {

            foreach ($std_requete->jointures as $jointure) {

                if ($jointure->table_left == $std_requete->tables[0]) {

                    if ($jointure->type_join == 'LEFT JOIN') {
                        $requete_finale = $requete_finale->leftjoin($jointure->table_right, $jointure->table_left .'.'. $jointure->field_left , "=", $jointure->table_right . '.' . $jointure->field_right);
                    } elseif ($jointure->type_join == 'RIGHT JOIN') {
                        $requete_finale = $requete_finale->rightjoin($jointure->table_right, $jointure->table_left .'.'. $jointure->field_left , "=", $jointure->table_right . '.' . $jointure->field_right);
                    } elseif ($jointure->type_join == 'INNER JOIN') {
                        $requete_finale = $requete_finale->join($jointure->table_right, $jointure->table_left .'.'. $jointure->field_left , "=", $jointure->table_right . '.' . $jointure->field_right);
                    }

                } elseif ($jointure->table_right == $std_requete->tables[0]) {

                    if ($jointure->type_join == 'LEFT JOIN') {
                        $requete_finale = $requete_finale->leftjoin($jointure->table_left, $jointure->table_right .'.'. $jointure->field_right , "=", $jointure->table_left . '.' . $jointure->field_left);
                    } elseif ($jointure->type_join == 'RIGHT JOIN') {
                        $requete_finale = $requete_finale->rightjoin($jointure->table_left, $jointure->table_right .'.'. $jointure->field_right , "=", $jointure->table_left . '.' . $jointure->field_left);
                    } elseif ($jointure->type_join == 'INNER JOIN') {
                        $requete_finale = $requete_finale->join($jointure->table_left, $jointure->table_right .'.'. $jointure->field_right , "=", $jointure->table_left . '.' . $jointure->field_left);
                    }

                }

            }
        }

        /**
         * Affichage
         */
        $selects = '';
        if (count($std_requete->affichage)) {
            $i = 0;
            foreach ($std_requete->affichage as $affichage) {
                if ($affichage->operation != "") {
                    $agregate = explode(' ', $affichage->operation)[0];
//                    $object = Capsule::raw($agregate. '('.$affichage->field.')');
//                    $selects[] = $object;
//                    if ($i == sizeof($std_requete->affichage)-1) {
//                        $selects .= Capsule::raw($agregate. '('.$affichage->field.')');
//                    } else {
//                        $selects .= Capsule::raw($agregate. '('.$affichage->field.')') . "` , `";
//                    }
                } else {
                    if ($i == sizeof($std_requete->affichage)-1) {
                        $selects .= $affichage->field;
                    } else {
                        $selects .= $affichage->field . "` , `";
                    }
                }
                $i++;
            }

        } else {
            //TODO : ERREUR MAJEURE => ARRET DU SCRIPT
        }

        $requete_finale = $requete_finale->select($selects);

        /**
         * Conditions
         */
        if (count($std_requete->conditions)) {
            foreach ($std_requete->conditions as $condition) {

                if (in_array($condition->operation, ['=', '<', '>', '<=', '>='])) {
                    $requete_finale = $requete_finale->where($condition->field, $condition->operation, intval($condition->value));
                } else {
                    $requete_finale = $requete_finale->where($condition->field, $condition->operation, $condition->value);
                }
            }

        }

        $requete_finale = str_replace('``', '`', $requete_finale->toSql());

        var_dump($requete_finale);
        exit();


        /**
         * Group by
         */
        if (count($std_requete->groupsby)) {
            $groups = '';
            $i=0;
            foreach ($std_requete->groupsby as $group) {
                $groups .= '->groupBy(';
                if ($i == sizeof($std_requete->groupsby)-1) {
                    $groups .= '"'.$group->field.'"';
                } else {
                    $groups .= '"'.$group->field.'",';
                }
                $groups .= ')';
                $i++;
            }
            $requete_finale .= $groups;
        }

        /**
         * Order by
         */
        if (count($std_requete->ordersby)) {
            $orders = '';
            foreach ($std_requete->ordersby as $order) {
                $orders .= '->orderBy(';
                $orders .= '"'.$order->field.'", "'.$order->sens.'")';
            }
            $requete_finale .= $orders;
        }

        /**
         * Limit
         */
        if (count($std_requete->limit)) {
            $requete_finale .= '->limit('.$std_requete->limit[0].')';
        }

        $requete_finale .= '->get();';

        $result = Capsule::table('zeapps_requetes')->select('*')->get();
        var_dump($result);
        exit();

        echo json_encode(array(
            'requeteResultats' => $requete_finale
        ));


    }
};