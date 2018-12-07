app.controller("ComZeappsRequetesGenereesNewCtrl", ["$scope", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");

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
        $scope.limits = [] ;
        $scope.paginations = [] ;

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
                            $scope.tables.push({module: $scope.moduleModelAddTable, table: $scope.tableModalAddTable, fields: Object.keys(response.data.fields)});

                            // Update list of folders of group by and order by
                            Object.keys(response.data.fields).forEach(function(elem) {
                                $scope.fieldsGroupAndOrderBy.push({field: $scope.tableModalAddTable + "." + elem});
                            });
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

        $scope.addPagination = function () {

            if ($scope.fieldModelPagination && $scope.fieldModelPagination != '') {

                // Close modal and append data
                $('#modalPagination').modal('hide');

                if ($scope.paginations.length === 0) {
                    $scope.paginations.push($scope.fieldModelPagination);
                }

                return true;
            }
        };

        $scope.addJointure = function () {
            $scope.jointures.push({table_left: '', field_left: '', type_join: '', table_right: '', field_right: ''});
        };


        // Get tables of a module
        $scope.saveRequest = function() {

            var arr_request = [] ;
            var validation = true;

            // Elements of request
            arr_request['tables'] = [] ;
            arr_request['jointures'] = [] ;
            arr_request['affichage'] = [] ;
            arr_request['conditions'] = [] ;
            arr_request['groupsby'] = [] ;
            arr_request['ordersby'] = [] ;
            arr_request['limit'] = [] ;
            arr_request['pagination'] = ['Non'] ;

            // Tables (obligé sinon requete invalide)
            if ($scope.tables.length > 0) {
                for (var i=0; i < $scope.tables.length; i++) {
                    arr_request['tables'].push($scope.tables[i].table);
                }
            } else {
                validation = false;
            }

            // Jointures
            if ($scope.jointures.length > 0) {
                for (var j=0; j < $scope.jointures.length; j++) {

                    // Jointure ajoutée au DOM mais au moins 1 champ non renseigné => pas de traitement
                    if ($scope.jointures[j] != undefined && $scope.jointures[j].table_left != ''
                        && $scope.jointures[j].field_left != '' && $scope.jointures[j].type_join != ''
                        && $scope.jointures[j].table_right != '' && $scope.jointures[j].field_right != '') {

                        arr_request['jointures'][j] = {
                            'table_left': $scope.jointures[j].table_left.table,
                            'table_right': $scope.jointures[j].table_right.table,
                            'type_join': $scope.jointures[j].type_join,
                            'field_left': $scope.jointures[j].field_left.name,
                            'field_right': $scope.jointures[j].field_right.name
                        };

                    } else {
                        alert('Au moins une jointure est non renseignée (ou incomplète).');
                        return false;
                    }
                }
            }

            // Affichage (Obligé sinon requete invalide)
            if ($scope.affichages.length > 0) {
                arr_request['affichage'] = $scope.affichages;
            } else {
                validation = false;
            }


            // Conditions
            for(var l = 0; l < $scope.conditions.length; l++) {
                delete $scope.conditions[l]['$$hashKey'];
            }
            arr_request['conditions'] = $scope.conditions ;

            // Group By
            for(var m = 0; m < $scope.groupsBy.length; m++) {
                delete $scope.groupsBy[m]['$$hashKey'];
            }
            arr_request['groupsby'] = $scope.groupsBy ;

            // Order By
            for(var n = 0; n < $scope.ordersBy.length; n++) {
                delete $scope.ordersBy[n]['$$hashKey'];
            }
            arr_request['ordersby'] = $scope.ordersBy ;

            // Limit
            arr_request['limit'] = $scope.limits ;

            // Pagination
            if ($scope.fieldPaginatiopn !== undefined) {
                arr_request['pagination'] = [$scope.fieldPaginatiopn];
            }

            var jsonObject = {
                'nom_requete' : $scope.nameRequest,
                'contenu' : Object.assign({}, arr_request)
            };

            if (validation) {
                zhttp.statistics.requetes_generees.save(jsonObject).then(function (response) {
                    if (response.data && response.data !== "false") {
                        if (isNaN(response.data) === false && response.data > 0) {
                            // Insert request is ok => redirect to list
                            $location.path("/ng/com_zeapps_statistics/requetes_generees/search");
                        }
                    }
                });
            } else {
                alert('Requête invalide, car au moins une des clauses suivantes n\'a pas été renseignée : \r\n - Table(s) \n - Affichage.');
            }

        };


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