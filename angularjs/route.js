app.config(["$routeProvider",

    function ($routeProvider) {

        $routeProvider

        ////////////////////// STATISTIQUES : LISTE REQUETES + REQUETEUR ////////////////////////
        //
            .when("/ng/com_zeapps_statistics/requetes_generees", {
                templateUrl: "/com_zeapps_statistics/requetes_generees/search",
                controller: "ComZeappsStatisticsRequestsListCtrl"
            })
            .when("/ng/com_zeapps_statistics/requetes_generees/get/:id_requete_generee", {
                templateUrl: "/com_zeapps_statistics/requetes_generees/view",
                controller: "ComZeappsRequetesGenereesViewCtrl"
            })
            .when("/ng/com_zeapps_statistics/requetes_generees/execute/:id_requete_generee", {
                templateUrl: "/com_zeapps_statistics/requetes_generees/result_request",
                controller: "ComZeappsRequetesGenereesExecuteCtrl"
            })
            .when("/ng/com_zeapps_statistics/requetes_generees/new", {
                templateUrl: "/com_zeapps_statistics/requetes_generees/new",
                controller: "ComZeappsRequetesGenereesCtrl"
            })
            .when("/ng/com_zeapps_statistics/requetes_generees/edit/:id", {
                templateUrl: "/com_zeapps_statistics/requetes_generees/new",
                controller: "ComZeappsRequetesGenereesCtrl"
            });

    }]);

