app.controller("ComZeappsStatisticsRequestsListCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_liste_requetes");

        $scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'name LIKE',
                    type: 'text',
                    label: 'Nom'
                },
                {
                    format: 'select',
                    field: 'id_activity',
                    type: 'text',
                    label: 'Activité',
                    options: []
                },
                {
                    format: 'select',
                    field: 'id_status',
                    type: 'text',
                    label: 'Statut',
                    options: []
                }
            ],
            secondaries: [
                {
                    format: 'input',
                    field: 'name_company LIKE',
                    type: 'text',
                    label: 'Entreprise',
                    size: 6
                },
                {
                    format: 'input',
                    field: 'name_contact LIKE',
                    type: 'text',
                    label: 'Contact',
                    size: 6
                }
            ]
        };
        $scope.filter_model = {};
        $scope.requetes_generees = [];
        $scope.page = 1;
        $scope.pageSize = 4;
        $scope.total = 0;
        $scope.templateForm = '/com_zeapps_statistics/requetes_generees/form_modal_traitement';

        $scope.loadList = loadList;
        $scope.goTo = goTo;
        $scope.getExcel = getExcel;

        loadList(true);

        function loadList(context) {
            context = context || "";
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);

            zhttp.statistics.requetes_generees.all($scope.pageSize, offset, context, formatted_filters).then(function (response) {

                if (response.status == 200) {
                    $scope.requetes_generees = response.data.requetes_generees;
                }
            });
        }

        function goTo(id) {
            $location.url('/ng/com_zeapps_statistics/requetes_generees/' + id);
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