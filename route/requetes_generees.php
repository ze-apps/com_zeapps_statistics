<?php
use Zeapps\Core\Routeur ;


// Route pour angularJS
Routeur::get('/com_zeapps_statistics/requetes_generees/search', 'App\\com_zeapps_statistics\\Controllers\\View@requetesGenereesSearch');
Routeur::get('/com_zeapps_statistics/requetes_generees/result_request', 'App\\com_zeapps_statistics\\Controllers\\View@view');
Routeur::get('/com_zeapps_statistics/requetes_generees/new', 'App\\com_zeapps_statistics\\Controllers\\View@requeteGenereeNew');


// get modules, tables and fields
Routeur::get("/com_zeapps_statistics/requetes_generees/get/{id}", 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@get');
Routeur::get("/com_zeapps_statistics/requetes_generees/execute/{id}", 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@execute');
Routeur::post("/com_zeapps_statistics/requetes_generees/getAll/{limit}/{offset}/{context}", 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getAll');
Routeur::post("/com_zeapps_statistics/requetes_generees/context/", 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@context');
Routeur::get('/com_zeapps_statistics/requetes_generees/modules', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getModules');
Routeur::get('/com_zeapps_statistics/requetes_generees/tables/{argModule}/{argWithFields}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getTables');
Routeur::get('/com_zeapps_statistics/requetes_generees/fields/{argModule}/{argTable}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getFields');
Routeur::get('/com_zeapps_statistics/requetes_generees/table/{argName}', 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@getTableFromName');
Routeur::post("/com_zeapps_statistics/requetes_generees/save", 'App\\com_zeapps_statistics\\Controllers\\RequetesGenerees@save');


// Modals of updates
Routeur::get('/com_zeapps_statistics/requetes_generees/modal_update_table', 'App\\com_zeapps_statistics\\Controllers\\View@updateTableModal');