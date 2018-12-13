app.controller("ComZeappsRequetesGenereesExecuteCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu",
    function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");


        zhttp.statistics.requetes_generees.execute($routeParams.id_requete_generee).then(function (response) {
            if (response.status == 200) {
                $scope.resultats = response.data.resultats;
                $scope.requete = response.data.requete;
            }
        });
    }]);