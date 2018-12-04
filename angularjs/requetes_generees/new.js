app.controller("ComZeappsRequetesGenereesNewCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");

        // Modals
        $scope.templateForm = '/com_zeapps_statistics/requetes_generees/form_modal_traitement';

        // Load all data
        $scope.loadModules = loadModules;
        $scope.loadTables = loadTables;
        $scope.loadFields = loadFields;


        // private variables
        $scope.moduleTables = [] ;
        $scope.tablesToAdd = [] ;

        $scope.moduleModelAddTable = null ;
        $scope.tableModalAddTable = null ;

        $scope.fieldModelAddField = null;
        $scope.operationModalAddField = null;

        $scope.fieldModelAddCondition = null;
        $scope.operationModalAddCondition = null;


        // default variables to load from Database
        $scope.tables = [] ;
        $scope.jointures = [] ;
        $scope.fields = [] ;
        $scope.affichages = [] ;
        $scope.conditions = [] ;
        $scope.groupsBy = [] ;

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



        // Select table drop-downs
        function loadFields(table)
        {
            if (table) {
                for(var i=0; i < $scope.fields.length; i++) {
                    if ($scope.fields[i].table == table.table) {
                        $scope.fieldsToAdd = $scope.fields[i].fields;
                    }
                }
            }
        }

        // Get tables of a module
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
                            $scope.fields.push({table: $scope.tableModalAddTable, fields:response.data.fields});
                            $scope.tables.push({module: $scope.moduleModelAddTable, table: $scope.tableModalAddTable, fields: $scope.fields});

                        }
                    });
                }

                return true;
            }
        };

        $scope.addAffichage = function () {

            if ($scope.fieldModelAddField && $scope.tableModelAddField && $scope.fieldModelAddField != '' && $scope.tableModelAddField != '') {

                // Close modal and append data
                $('#modalAffichage').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < $scope.affichages.length; i++) {

                    if ($scope.affichages[i].field == $scope.fieldModelAddField && $scope.affichages[i].operation == $scope.operationModalAddField) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {
                    $scope.affichages.push({field: $scope.fieldModelAddField, operation: $scope.operationModalAddField});
                }

                return true;
            }
        };

        $scope.addCondition = function () {

            if ($scope.tableModelAddCondition && $scope.fieldModelAddCondition && $scope.operationModalAddCondition && $scope.valueModalAddCondition &&
                $scope.tableModelAddCondition != '' && $scope.fieldModelAddCondition != '' &&  $scope.operationModalAddCondition != '' && $scope.valueModalAddCondition != '') {

                // Close modal and append data
                $('#modalCondition').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < $scope.conditions.length; i++) {

                    if ($scope.conditions[i].field == $scope.fieldModelAddCondition && $scope.conditions[i].operation == $scope.operationModalAddCondition) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {
                    $scope.conditions.push({field: $scope.fieldModelAddCondition, operation: $scope.operationModalAddCondition, value: $scope.valueModalAddCondition});
                }

                return true;
            }
        };

        $scope.addGroupBy = function () {

            /*console.log($scope.affichages);
            return false;*/

            var arrFields = [] ;

            for(var j=0; j<$scope.affichages.length; j++) {
                if (jQuery.inArray($scope.affichages[j].field, arrFields) !== -1) {
                    arrFields.push($scope.affichages[j].field);
                }
            }

            console.log(arrFields);

            return false;




            if ($scope.fieldModelAddGroupBy && $scope.fieldModelAddGroupBy != '' && $scope.fieldModelAddGroupBy == 'email') {

                // Close modal and append data
                $('#modalGroupePar').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < $scope.groupsBy.length; i++) {

                    if ($scope.groupsBy[i].field == $scope.fieldModelAddGroupBy) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {
                    $scope.groupsBy.push({field: $scope.fieldModelAddGroupBy});
                }

                return true;
            }
        };



        $scope.addJointure = function () {
            $scope.jointures.push({table_left: '', field_left: '', operation: '', table_right: '', field_right: ''});
        };

        $scope.getFieldsOfSelectedTableLeft = getFieldsOfSelectedTableLeft;
        function getFieldsOfSelectedTableLeft(table) {
            if (table != null) {
                var selectedTable = table.table;
                for(var i=0; i<$scope.fields.length; i++) {
                    if ($scope.fields[i].table == selectedTable) {
                        $scope.fieldsLeft = $scope.fields[i].fields;
                    }
                }
            }
        }

        $scope.getFieldsOfSelectedTableRight = getFieldsOfSelectedTableRight;
        function getFieldsOfSelectedTableRight(table) {
            if (table != null) {
                var selectedTable = table.table;
                for(var i=0; i<$scope.fields.length; i++) {
                    if ($scope.fields[i].table == selectedTable) {
                        $scope.fieldsRight = $scope.fields[i].fields;
                    }
                }
            }
        }

        $scope.supprimerCetteJointure = supprimerCetteJointure;
        function supprimerCetteJointure(jointure) {

            for (var i=0; i < $scope.jointures.length; i++) {

                if ($scope.jointures[i].$$hashKey === jointure.$$hashKey) {
                    $scope.jointures.splice(i, 1);
                    break;
                }
            }
        }

}]);