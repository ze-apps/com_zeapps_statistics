app.controller("ComZeappsStatisticsRequestsListCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_liste_requetes");

        $scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'nom_requete LIKE',
                    type: 'text',
                    label: 'Nom'
                },
                {
                    format: 'input',
                    field: 'contenu LIKE',
                    type: 'text',
                    label: 'Contenu'
                }
            ]
        };
        $scope.filter_model = {};
        $scope.requetes_generees = [];
        $scope.page = 1;
        $scope.pageSize = 4;
        $scope.total = 0;

        $scope.loadList = loadList;

        $scope.execute = execute;
        $scope.edit = edit;


        $scope.goTo = goTo;
        $scope.getExcel = getExcel;

        loadList(true);

        function loadList(context) {
            context = context || "";
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);

            zhttp.statistics.requetes_generees.all($scope.pageSize, offset, context, formatted_filters).then(function (response) {
                if (response.status == 200) {
                    $scope.requetesGenerees = response.data.requetes_generees;
                }
            });
        }

        function goTo(id) {
            $location.url('/ng/com_zeapps_statistics/requetes_generees/' + id);
        }


        // Actions

        function execute(requeteGeneree) {
            var id_requete = requeteGeneree.id;
            zhttp.statistics.requetes_generees.execute(id_requete).then(function (response) {
                if (response.status == 200) {
                    $scope.requeteResultats = response.data.requeteResultats;
                    console.log($scope.requeteResultats);
                    $location.url('/ng/com_zeapps_statistics/requetes_generees/execute/' + id_requete);
                }
            });
        }

        function edit(requeteGeneree) {
            console.log(requeteGeneree);
        }



        function getExcel() {
            var formatted_filters = angular.toJson($scope.filter_model);
            zhttp.statistics.requetes_generees.excel.make(formatted_filters).then(function (response) {
                if (response.data && response.data !== "false") {
                    window.document.location.href = zhttp.statistics.requetes_generees.excel.get();
                } else {
                    toasts('info', "Aucune requete générée correspondante à vos critères n'a pu etre trouvée");
                }
            });
        }

}]);