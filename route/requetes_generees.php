<?php
use Zeapps\Core\Routeur ;


// Route pour angularJS
Routeur::get('/com_zeapps_statistics/requetes_generees/search', 'App\\com_zeapps_statistics\\Controllers\\View@RequetesGenereesSearch');
Routeur::get('/com_zeapps_statistics/requetes_generees/requeteur', 'App\\com_zeapps_statistics\\Controllers\\View@requeteGenereeRequeteur');

Routeur::get('/com_zeapps_statistics/requetes_generees/view', 'App\\com_zeapps_statistics\\Controllers\\View@view');
Routeur::get('/com_zeapps_statistics/requetes_generees/form_modal_traitement', 'App\\com_zeapps_statistics\\Controllers\\View@RequetesGenereesFormModalTraitement');