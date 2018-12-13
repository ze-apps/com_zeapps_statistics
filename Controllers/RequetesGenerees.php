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
                $requete_finale = $requete_finale->where($condition->field, $condition->operation, $condition->value);
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

    public function deleteElement(Request $request)
    {
        $id = $request->input('id_requete_generee', 0);
        $elemDelete = $request->input('elem', '');
        $typeDelete = $request->input('type', '');

        $reqGenModel = ReqGenModel::where('id', $id)->first();
        $tab_contenu = json_decode($reqGenModel->contenu);

        if ($typeDelete !== '') {

            switch ($typeDelete) {

                case 'table' : {

                    // Suppression d'une table avant la jointure interdite
                    if (count($tab_contenu->jointures)) {
                        foreach ($tab_contenu->jointures as $join) {
                            if ($join->table_left->table == $elemDelete || $join->table_right->table == $elemDelete) {
                                echo 'Impossible de supprimer cette table, car elle est utilisée dans une jointure.';
                                exit();
                            }
                        }
                    }

                    $tab_contenu->tables = $this->deleteTable($tab_contenu->tables, $elemDelete, 'table');
                    $tab_contenu->fields = $this->deleteTable($tab_contenu->fields, $elemDelete, 'table');
                    $tab_contenu->affichages = $this->deleteTable($tab_contenu->affichages, $elemDelete, 'field');
                    $tab_contenu->conditions = $this->deleteTable($tab_contenu->conditions, $elemDelete, 'field');
                    $tab_contenu->groupsBy = $this->deleteTable($tab_contenu->groupsBy, $elemDelete, 'field');
                    $tab_contenu->ordersBy = $this->deleteTable($tab_contenu->ordersBy, $elemDelete, 'field');

                    break;
                }

                case 'jointure' : {

                    // TODO : delete jointure here
                    // TODO : delete jointure here
                    // TODO : delete jointure here
                    // TODO : delete jointure here
                    // TODO : delete jointure here
                    // TODO : delete jointure here
                    // TODO : delete jointure here

                    $tab_contenu->affichages = $this->deleteTable($tab_contenu->affichages, $elemDelete, 'field');
                    $tab_contenu->conditions = $this->deleteTable($tab_contenu->conditions, $elemDelete, 'field');
                    $tab_contenu->groupsBy = $this->deleteTable($tab_contenu->groupsBy, $elemDelete, 'field');
                    $tab_contenu->ordersBy = $this->deleteTable($tab_contenu->ordersBy, $elemDelete, 'field');

                    break;
                }

                case 'affichage' : {

                    $tab_contenu->affichages = $this->deleteItem(json_decode(json_encode($tab_contenu->affichages), true), $elemDelete);
                    break;
                }

                case 'condition' :
                    $tab_contenu->conditions = $this->deleteItem(json_decode(json_encode($tab_contenu->conditions), true), $elemDelete);
                    break;

                case 'groupBY' :
                    $tab_contenu->groupsBy = $this->deleteItem(json_decode(json_encode($tab_contenu->groupsBy), true), $elemDelete);
                    break;

                case 'orderBy' :
                    $tab_contenu->ordersBy = $this->deleteItem(json_decode(json_encode($tab_contenu->ordersBy), true), $elemDelete);
                    break;

                case 'limit' : {

                    if (count($tab_contenu->limits)) {
                        $tab_contenu->limits = array();
                    }

                    break;
                }

                case 'pagination' :
                    {
                        // TODO : pagination
                        // TODO : pagination
                        // TODO : pagination
                        // TODO : pagination
                        // TODO : pagination
                        break;
                    }

                default:
                    break;
            }

            // Update Json in DB
            $reqGenModel->contenu = json_encode($tab_contenu);
            $reqGenModel->save();
        }

        echo 'Element of request deleted';
    }

    /**
     * @param $array : Collection of data where $element will be deleted
     * @param $element : Element, data to delete
     * @param $attribute : Type of element (Table, jointure, affichage, condition....)
     * @return int : status of delete action
     */
    private function deleteTable($array, $element, $attribute)
    {
        $i = 0;
        foreach ($array as $item) {

            if (isset($item->$attribute)) {

                $explode = explode('.', $item->$attribute);
                if ($item->$attribute == $element || $explode[0] == $element) {
                    unset($array[$i]);
                    break;
                }
            }

            $i++;
        }

        // Return new array updated
        return $array;
    }

    /**
     * @param $array : Collection of data where $element will be deleted
     * @param $element : Element, data to delete
     * @return int : status of delete action
     */
    private function deleteItem($array, $element)
    {
        foreach ($array as $key => $value) {

            if (isset($value['field']) && $value['field'] == $element) {
                unset($array[$key]);
                break;
            }
        }

        // Return new array updated
        return $array;
    }

};