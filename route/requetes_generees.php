<?php
use Zeapps\Core\Routeur ;


// Route pour angularJS
Routeur::get('/com_zeapps_statistics/requetes_generees/search', 'App\\com_zeapps_statistics\\Controllers\\View@RequetesGenereesSearch');
Routeur::get('/com_zeapps_statistics/requetes_generees/new', 'App\\com_zeapps_statistics\\Controllers\\View@requeteGenereeNew');

Routeur::get('/com_zeapps_statistics/requetes_generees/form_modal_traitement', 'App\\com_zeapps_statistics\\Controllers\\View@RequetesGenereesFormModalTraitement');





// get modules, tables and fields
Routeur::get('/com_zeapps_statistics/requetes_generees/modules', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getModules');
Routeur::get('/com_zeapps_statistics/requetes_generees/tables/{argModule}/{argWithFields}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getTables');
Routeur::get('/com_zeapps_statistics/requetes_generees/fields/{argModule}/{argTable}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getFields');