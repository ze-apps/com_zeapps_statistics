app.controller("ComZeappsRequetesGenereesNewCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");

        // Modals
        $scope.templateForm = '/com_zeapps_statistics/requetes_generees/form_modal_traitement';

        // Load all data
        $scope.loadModules = loadModules;
        $scope.loadTables = loadTables;

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

            zhttp.statistics.requetes_generees.tablesWithFields(module).then(function (response) {
                if (response.status === 200) {
                    $scope.tables = response.data.tables;

//console.log($scope.tables);
                    /*$.each($scope.tables, function( key, value ) {
                        zhttp.statistics.requetes_generees.fields(module, value['sqlName']).then(function (response) {
                            if (response.status === 200) {
                                $scope.fields = response.data.fields;

                                var arr_fields = [];
                                $.each($scope.fields, function( key, value ) {
                                    arr_fields.push(key);
                                });

                                arr_tables[value['sqlName']] = arr_fields;
                            }
                        });
                    });*/

                }
            });
        }

}]);