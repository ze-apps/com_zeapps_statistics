app.controller("ComZeappsRequetesGenereesNewCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");

        // Modals
        $scope.templateForm = '/com_zeapps_statistics/requetes_generees/form_modal_traitement';

        // Load all data
        $scope.loadModules = loadModules;
        $scope.loadTables = loadTables;
        $scope.loadSelecteds = loadSelecteds;

        // Load defaults modules
        loadModules();

        // Function implementations =>  Get data from backend controller
        function loadModules()
        {
            zhttp.statistics.requetes_generees.modules().then(function (response) {
                if (response.status === 200) {
                    $scope.modules = response.data.modules;
                }
            });
        }

        // Get tables of a defined
        function loadTables(module)
        {
            zhttp.statistics.requetes_generees.tables(module).then(function (response) {
                if (response.status === 200) {
                    $scope.tables = response.data.tables;
                    tables = $scope.tables;
                }
            });
        }

        // Get tables of a defined
        function loadSelecteds(module, table)
        {
            zhttp.statistics.requetes_generees.fields(modules[0], tables[3]['sqlName']).then(function (response) {

                if (response.status === 200) {
                    $scope.selecteds = response.data.selecteds;
                    fields = $scope.selecteds;
                }
            });
        }

        $scope.updateTables = updateTables;
        function updateTables()
        {
            var module = $('#selectModule').val();
            var table = $('#selectTable').val();
            if (table != '' && module != '') {
                //$scope.lignesTables = table.
            }
        }

}]);