app.controller("ComZeappsRequetesGenereesNewCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");

        // Modals
        $scope.templateForm = '/com_zeapps_statistics/requetes_generees/form_modal_traitement';

        // Load all data
        $scope.loadModules = loadModules;
        $scope.loadTables = loadTables;



        // private variables
        $scope.moduleTables = [] ;
        $scope.tablesToAdd = [] ;

        $scope.moduleModelAddTable = null ;
        $scope.tableModalAddTable = null ;

        // default variables to load from Database
        $scope.tables = [] ;
        $scope.jointures = [] ;
        $scope.fields = [] ;

        // Function implementations =>  Get data from backend controller
        function loadModules()
        {
            zhttp.statistics.requetes_generees.modules().then(function (response) {
                if (response.status === 200) {
                    $scope.moduleTables = response.data.modules;
                }
            });
        }

        // Load defaults modules
        loadModules();



        // Get tables of a defined
        function loadTables(module)
        {
            $scope.tablesToAdd = [];
            zhttp.statistics.requetes_generees.tablesWithFields(module).then(function (response) {
                if (response.status === 200) {
                    $scope.tablesToAdd = response.data.tables;
                }
            });
        }


        $scope.addTable = function () {

            if ($scope.moduleModelAddTable && $scope.tableModalAddTable && $scope.moduleModelAddTable != '' && $scope.tableModalAddTable != '') {
                // Close modal and append data
                $('#modalTable').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < $scope.tables.length; i++) {

                    if ($scope.tables[i].module == $scope.moduleModelAddTable && $scope.tables[i].table == $scope.tableModalAddTable) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    // Get fields from back-end
                    zhttp.statistics.requetes_generees.fields($scope.moduleModelAddTable, $scope.tableModalAddTable).then(function (response) {
                        if (response.status === 200) {
                            $scope.fields = response.data.fields;
                            $scope.tables.push({module: $scope.moduleModelAddTable, table: $scope.tableModalAddTable, fields: $scope.fields});
                        }
                    });
                }

                return true;
            }
        };


        $scope.addJointure = function () {
            $scope.jointures.push({table_left:''});
        };

        $scope.getFieldsOfSelectedTableLeft = getFieldsOfSelectedTableLeft;
        function getFieldsOfSelectedTableLeft(table) {
            if (table != null) {
                $scope.fieldsLeft = table.fields;
            }
        }

        $scope.getFieldsOfSelectedTableRight = getFieldsOfSelectedTableRight;
        function getFieldsOfSelectedTableRight(table) {
            if (table != null) {
                $scope.fieldsRight = table.fields;
            }
        }

        $scope.supprimerCetteJointure = supprimerCetteJointure;
        function supprimerCetteJointure(jointure) {

            console.log('avant ' + $scope.jointures);

            for (var i=0; i<$scope.jointures.length; i++) {

                if ($scope.jointures[i].$$hashKey === jointure.$$hashKey) {
                    delete $scope.jointures[i];
                }
            }

            console.log('apres ' + $scope.jointures);
        }

}]);