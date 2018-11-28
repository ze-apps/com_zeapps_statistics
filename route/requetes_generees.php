<?php
use Zeapps\Core\Routeur ;


// Route pour angularJS
Routeur::get('/com_zeapps_statistics/requetes_generees/search', 'App\\com_zeapps_statistics\\Controllers\\View@RequetesGenereesSearch');
Routeur::get('/com_zeapps_statistics/requetes_generees/requeteur', 'App\\com_zeapps_statistics\\Controllers\\View@requeteGenereeRequeteur');

Routeur::get('/com_zeapps_statistics/requetes_generees/view', 'App\\com_zeapps_statistics\\Controllers\\View@view');
Routeur::get('/com_zeapps_statistics/requetes_generees/form_modal_traitement', 'App\\com_zeapps_statistics\\Controllers\\View@RequetesGenereesFormModalTraitement');





// get modules, tables and fields
Routeur::get('/com_zeapps_statistics/requetes_generees/modules', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getModules');
Routeur::get('/com_zeapps_statistics/requetes_generees/tables/{argModule}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getTables');
Routeur::get('/com_zeapps_statistics/requetes_generees/fields/{argModule}/{argTable}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getFields');