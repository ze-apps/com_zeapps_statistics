<?php

/********** CONFIG MENU ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_ze_apps_opportunity_activities" ;
$tabMenu["space"] = "com_ze_apps_config" ;
$tabMenu["label"] = "Activités" ;
$tabMenu["fa-icon"] = "activity" ;
$tabMenu["url"] = "/ng/com_zeapps/opportunity_activities" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 39 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_ze_apps_opportunity_status" ;
$tabMenu["space"] = "com_ze_apps_config" ;
$tabMenu["label"] = "Status" ;
$tabMenu["fa-icon"] = "signal" ;
$tabMenu["url"] = "/ng/com_zeapps/opportunity_status" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 40 ;
$menuLeft[] = $tabMenu ;


/************** insert in left menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_statistics_liste_requetes";
$tabMenu["space"] = "com_zeapps_statistics" ;
$tabMenu["label"] = "Liste des requetes" ;
$tabMenu["fa-icon"] = "database" ;
$tabMenu["url"] = "/ng/com_zeapps_statistics/requetes_generees/search" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 0 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_statistics_requeteur";
$tabMenu["space"] = "com_zeapps_statistics" ;
$tabMenu["label"] = "Nouvelle requête";
$tabMenu["fa-icon"] = "database" ;
$tabMenu["url"] = "/ng/com_zeapps_statistics/requetes_generees/new" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 0 ;
$menuLeft[] = $tabMenu ;


/*************** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_statistics_liste_requetes" ;
$tabMenu["space"] = "com_zeapps_statistics" ;
$tabMenu["label"] = "Liste des requetes" ;
$tabMenu["fa-icon"] = "database" ;
$tabMenu["url"] = "/ng/com_zeapps_statistics/requetes_generees/search" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 0 ;
$menuHeader[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_statistics_requeteur" ;
$tabMenu["space"] = "com_zeapps_statistics" ;
$tabMenu["label"] = "Nouvelle requête";
$tabMenu["fa-icon"] = "database" ;
$tabMenu["url"] = "/ng/com_zeapps_statistics/requetes_generees/new" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 0 ;
$menuHeader[] = $tabMenu ;