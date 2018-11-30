<?php

namespace App\com_zeapps_statistics\Controllers;

use App\com_zeapps_statistics\Models\Activity;
use App\com_zeapps_statistics\Models\Note;
use App\com_zeapps_statistics\Models\Status;
use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use App\com_zeapps_statistics\Models\RequeteGeneree as ReqGenModel;
use Zeapps\libraries\PHPExcel;

use Zeapps\Core\ModelRequest;

class RequetesGenerees extends Controller
{
    ///////////////////// Vue de la liste des commandes //////////////////////
    ///
    private $dates = ['24/10/2018', '25/10/2018', '26/10/2018', '29/10/2018', '30/10/2018', '31/10/2018', '01/11/2018', '02/11/2018', '05/11/2018', '06/11/2018'];
    private $numeros = [14904, 14905, 15002, 15003, 15094, 15095, 15204, 15205, 15333, 15335];
    private $clients = ['Café Marly Paris Louvre',
        'Campanile Saint Germain en Laye',
        'Concept Ibis',
        'Concepts McDonald\'s',
        'Culture Bière Champs Elysées',
        'Ecole des Greffes de Dijon',
        'Hôpital Sainte Anne Paris',
        'Ibis Styles Nantes Centre Graslin',
        'Ibis Styles Nice Centre Gare',
        'Indiana Saint Cloud'];
    private $objets = ['Mise en place d\'une collection complète de mobilier',
        'Banquettes Orchestre habillées de grands coussins et tables sur-mesure',
        'Déploiement du nouveau concept IBIS',
        'Partenariat avec McDonald\'s',
        'Un "concept store" imaginé par Heineken',
        'Choix de la banquette Orchestre, pour zone d\'accueil ou lecture',
        'Création des zones d\'accueil aux ambiances variées',
        'Mise en valeur des expositions temporaires de peintres contemporains',
        'Conception d\'espace d\'accueil et de petit déjeuner pour l\'hôtel Ibis',
        'Une réelle expérience Tex Mex'];
    private $nombre_articles = [30, 31, 103, 27, 38, 96, 76, 118, 44, 24];
    private $commerciaux = ['François DUPONT', 'Mathieu DOS SANTOS', 'Sylvie MARCHAND', 'Sylvie MARCHAND', 'François DUPONT', 'François DUPONT', 'François DUPONT', 'Mathieu DOS SANTOS', 'François DUPONT', 'Sylvie MARCHAND'];
    private $dates_livraison = ['09/11/2018', '08/11/2018', '03/11/2018', '01/11/2018', '31/10/2018', '31/10/2018', '04/11/2018', '12/10/2018', '25/09/2018', '22/09/2018'];

    /////////////////// Vue détail d'une commande /////////////////////////
    ///
    private $dates_lancement = ['01/10/2018', '30/08/2018', '03/06/2018', '01/02/2018', '07/07/2018', '27/08/2018', '09/09/2018', '21/09/2018', '21/07/2018', '22/07/2018'];
    private $dates_expedition = ['25/10/2018', '26/11/2018', '28/10/2018', '25/10/2018', '25/10/2018', '17/10/2018', '29/10/2018', '06/10/2018', '20/09/2018', '18/09/2018'];
    private $temps_unitaires = [236, 149, 252, 252, 319, 125, 645, 205, 233, 305];
    private $titres_articles = ['Chaise Bridge Frizz',
        'Banquette Tablette Couple',
        'Chaise Café Marly',
        'Chaise CAL',
        'Fauteuil Lollipop',
        'Chaise Camille',
        'Chaise Bridge Magic Window',
        'Chaise Bridge CAL',
        'Chaise Bridge Café Marly',
        'Chaise Bridge 2C'];
    private $bureaux_etude = ['BE',
        'Menuiserie',
        'Tapisserie',
        'Achat',
        'Menuiserie',
        'Achat',
        'BE',
        'Expédition',
        'Achat',
        'Livraison'];


    //////////////////// Tableau des objets de commandes pour les requetes ///////////////////////////
    ///
    private $commandes;

    /**
     * Commandes constructor.
     * @param array $dates
     */
    public function __construct()
    {
        $this->commandes = array();
        $id = 1;
        for ($j = 0; $j < 2; $j++) {
            for ($i = 0; $i < 10; $i++) {

                /////////////// Vue de la liste des commandes ///////////////
                $commande = new \stdClass();
                $commande->id = $id;
                $commande->date = $this->dates[$i];
                $commande->numero = $j == 0 ? $this->numeros[$i] : $this->numeros[$i] * 2;
                $commande->client = $this->clients[$i];
                $commande->objet = $this->objets[$i];
                $commande->nb_articles = $j == 0 ? $this->nombre_articles[$i] : ceil($this->nombre_articles[$i] / 2);
                $commande->commercial = $this->commerciaux[$i];
                $commande->date_livraison = $this->dates_livraison[$i];

                $commande->bureau_etude = $this->bureaux_etude[$i];

                //////////////// Vue détail d'une commande //////////////////
                $commande->date_lancement = $this->dates_lancement[$i];
                $commande->date_expedition = $this->dates_expedition[$i];
                $commande->temps_unitaire = $this->temps_unitaires[$i];
                $commande->titre_article = $this->titres_articles[$i];

                array_push($this->commandes, $commande);
                $id++;
            }
        }
    }

    public function getAll()
    {
        echo json_encode(array(
            'commandes' => $this->commandes
        ));
    }

    public function getAllPlannings()
    {
        $commandes_plannings = array();

        $id = 1;
        $id_planning = 1;
        for ($j = 0; $j < 2; $j++) {
            for ($i = 0; $i < 10; $i++) {

                /////////////// Vue de la liste des commandes ///////////////
                $commande = new \stdClass();
                $commande->id = $id;
                $commande->date = $this->dates[$i];
                $commande->numero = $j == 0 ? $this->numeros[$i] : $this->numeros[$i] * 2;
                $commande->client = $this->clients[$i];
                $commande->objet = $this->objets[$i];
                $commande->nb_articles = $j == 0 ? $this->nombre_articles[$i] : ceil($this->nombre_articles[$i] / 2);
                $commande->commercial = $this->commerciaux[$i];
                $commande->date_livraison = $this->dates_livraison[$i];

                $commande->bureau_etude = $this->bureaux_etude[$i];

                //////////////// Vue détail d'une commande //////////////////
                $commande->date_lancement = $this->dates_lancement[$i];
                $commande->date_expedition = $this->dates_expedition[$i];
                $commande->temps_unitaire = $this->temps_unitaires[$i];
                $commande->titre_article = $this->titres_articles[$i];

                array_push($commandes_plannings, $commande);

                if (($i == 0 || $i == 3 || $i == 7) && ($j == 0 || $j == 1)) {
                    $commande = new \stdClass();
                    $commande->commande = 'Commande n° : ' . $id_planning;
                    array_push($commandes_plannings, $commande);
                    $id_planning++;
                } else {
                    $commande->ligne = true;
                }

                $id++;
            }
        }

        echo json_encode(array(
            'commandes' => $commandes_plannings
        ));
    }

    public function suivi_commandes()
    {
        echo json_encode(array(
            'commandes' => $this->commandes
        ));
    }

    public function context()
    {

    }

    public function get(Request $request)
    {
        $id = $request->input('id', 0);

        $commande = new \stdClass();
        foreach ($this->commandes as $item) {
            if ($item->id == $id) {

                $commande->id = $item->id;
                $commande->date = $item->date;
                $commande->numero = $item->numero;
                $commande->client = $item->client;
                $commande->objet = $item->objet;
                $commande->nb_articles = $item->nb_articles;
                $commande->commercial = $item->commercial;
                $commande->date_livraison = $item->date_livraison;

                //////////////// Vue détail d'une commande //////////////////
                $commande->date_lancement = $item->date_lancement;
                $commande->date_expedition = $item->date_expedition;
                $commande->temps_unitaire = $item->temps_unitaire;
                $commande->titre_article = $item->titre_article;

                break;
            }
        }

        echo json_encode(array(
            'commande' => $commande
        ));
    }

    public function planning(Request $request)
    {
        $id = $request->input('id', 0);

        $commande = new \stdClass();
        foreach ($this->commandes as $item) {
            if ($item->id == $id) {

                $commande->id = $item->id;
                $commande->date = $item->date;
                $commande->numero = $item->numero;
                $commande->client = $item->client;
                $commande->objet = $item->objet;
                $commande->nb_articles = $item->nb_articles;
                $commande->commercial = $item->commercial;
                $commande->date_livraison = $item->date_livraison;

                //////////////// Vue détail d'une commande //////////////////
                $commande->date_lancement = $item->date_lancement;
                $commande->date_expedition = $item->date_expedition;
                $commande->temps_unitaire = $item->temps_unitaire;
                $commande->titre_article = $item->titre_article;

                break;
            }
        }

        echo json_encode(array(
            'commande' => $commande
        ));
    }


    public function make_export()
    {
        $commandes = $this->commandes;

        if ($commandes) {

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->getActiveSheet()->setCellValue('A1', "Date");
            $objPHPExcel->getActiveSheet()->setCellValue('B1', "#");
            $objPHPExcel->getActiveSheet()->setCellValue('C1', "Client");
            $objPHPExcel->getActiveSheet()->setCellValue('D1', "Objet");
            $objPHPExcel->getActiveSheet()->setCellValue('E1', "Nb Articles");
            $objPHPExcel->getActiveSheet()->setCellValue('F1', "Commercial");
            $objPHPExcel->getActiveSheet()->setCellValue('G1', "Date livraison");

            foreach ($commandes as $key => $commande) {
                $i = $key + 2;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $commande->date);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $commande->numero);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $commande->client);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $commande->objet);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $commande->nb_articles);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $commande->commercial);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $commande->date_livraison);
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

            recursive_mkdir(FCPATH . 'tmp/com_zeapps_statistics/commandes/');

            $objWriter->save(FCPATH . 'tmp/com_zeapps_statistics/commandes/commandes.xlsx');

            echo json_encode(true);

        } else {

            echo json_encode(false);
        }
    }

    public function get_export()
    {

        $file_url = FCPATH . 'tmp/com_zeapps_statistics/commandes/commandes.xlsx';

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");

        readfile($file_url);
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
};