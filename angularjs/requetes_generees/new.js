app.controller("ComZeappsRequetesGenereesNewCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");

        // Modals
        $scope.templateForm = '/com_zeapps_statistics/requetes_generees/form_modal_traitement';

        // Load all data
        $scope.loadModules = loadModules;
        $scope.loadTables = loadTables;
        $scope.loadFields = loadFields;

        $scope.saveRequest = saveRequest;

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
        $scope.limits = [] ;

        $scope.groupsBy = [] ;
        $scope.ordersBy = [] ;

        $scope.fieldsGroupAndOrderBy = [] ;

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

                    if ($scope.affichages[i].field == $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField &&
                        $scope.affichages[i].operation == $scope.operationModalAddField) {

                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    $scope.affichages.push({field: $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField, operation: $scope.operationModalAddField});

                    // Update list of group by
                    for(var j=0; j < $scope.affichages.length; j++) {

                        var insere = true;
                        for(k in $scope.fieldsGroupAndOrderBy) {
                            if ($scope.fieldsGroupAndOrderBy[k].field  === $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField) {

                                insere = false;
                                break;
                            }
                        }

                        if (insere) {
                            $scope.fieldsGroupAndOrderBy.push({ field: $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField });
                        }
                    }
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

                    if ($scope.conditions[i].field == $scope.tableModelAddCondition.table + '.' + $scope.fieldModelAddCondition && $scope.conditions[i].operation == $scope.operationModalAddCondition) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {
                    $scope.conditions.push({field: $scope.tableModelAddCondition.table + '.' + $scope.fieldModelAddCondition, operation: $scope.operationModalAddCondition, value: $scope.valueModalAddCondition});
                }

                return true;
            }
        };

        $scope.addGroupBy = function () {

            if ($scope.fieldModelAddGroupBy && $scope.fieldModelAddGroupBy != '') {

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

        $scope.addOrderBy = function () {

            if ($scope.fieldModelAddOrderBy && $scope.fieldModelAddOrderBy != '' && $scope.fieldSensAddOrderBy && $scope.fieldSensAddOrderBy != '') {

                // Close modal and append data
                $('#modalOrdonnePar').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < $scope.ordersBy.length; i++) {

                    if ($scope.ordersBy[i].field == $scope.fieldModelAddOrderBy) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {
                    $scope.ordersBy.push({field: $scope.fieldModelAddOrderBy, sens: $scope.fieldSensAddOrderBy});
                }

                return true;
            }
        };

        $scope.addLimit = function() {

            if ($scope.valueAddLimit && $scope.valueAddLimit != '' ) {

                // Close modal and append data
                $('#modalLimit').modal('hide');

                if ($scope.limits.length === 0) {
                    $scope.limits.push($scope.valueAddLimit);
                }

                return true;
            }

        };


        $scope.addJointure = function () {
            $scope.jointures.push({table_left: '', field_left: '', operation: '', table_right: '', field_right: ''});
        };


        // Get tables of a module
        function saveRequest()
        {
            var arr_request = [] ;
            arr_request['tables'] = [] ;

            // Name of request
            arr_request['nameRequest'] = $scope.nameRequest;

            // Tables
            if ($scope.tables.length > 0) {
                for (var i=0; i < $scope.tables.length; i++) {
                    arr_request['tables'].push($scope.tables[i].table);
                }
            }

            console.log(arr_request['tables']);

            arr_request['moduleTables'] = $scope.moduleTables;
            console.warn($scope.tables);
        }


        $scope.getFieldsOfSelectedTableLeft = getFieldsOfSelectedTableLeft;
        function getFieldsOfSelectedTableLeft(table, jointure) {
            if (table != null) {
                var selectedTable = table.table;
                for(var i=0; i<$scope.fields.length; i++) {
                    if ($scope.fields[i].table == selectedTable) {
                        jointure.fieldsLeft = $scope.fields[i].fields;
                    }
                }
            }
        }

        $scope.getFieldsOfSelectedTableRight = getFieldsOfSelectedTableRight;
        function getFieldsOfSelectedTableRight(table, jointure) {
            if (table != null) {
                var selectedTable = table.table;
                for(var i=0; i<$scope.fields.length; i++) {
                    if ($scope.fields[i].table == selectedTable) {
                        jointure.fieldsRight = $scope.fields[i].fields;
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