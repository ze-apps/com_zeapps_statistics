app.controller("ComZeappsRequetesGenereesCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeapps_modal, menu) {

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
        $scope.id = 0 ;
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
                for (var i = 0; i < $scope.fields.length; i++) {
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


        // reload request
        if ($routeParams.id) {
            zhttp.statistics.requetes_generees.get($routeParams.id).then(function (response) {
                if (response.status === 200) {
                    var dataJson = JSON.parse(response.data.contenu);

                    $scope.id = $routeParams.id;
                    $scope.nameRequest = response.data.nom_requete;
                    $scope.tables = dataJson.tables;
                    $scope.jointures = dataJson.jointures;
                    $scope.affichages = dataJson.affichages;
                    $scope.conditions = dataJson.conditions;
                    $scope.limits = dataJson.limits;
                    $scope.paginations = dataJson.paginations;

                    $scope.groupsBy = dataJson.groupsBy;
                    $scope.ordersBy = dataJson.ordersBy;


                    // repeuple les jointures avec les objets javascript qui sont en mémoire sinon ne fonctionne pas
                    if ($scope.jointures && $scope.jointures.length) {
                        for (var iJointures = 0; iJointures < $scope.jointures.length; iJointures++) {
                            for (var iTables = 0; iTables < $scope.tables.length; iTables++) {
                                if ($scope.tables[iTables].module == $scope.jointures[iJointures].table_left.module && $scope.tables[iTables].table == $scope.jointures[iJointures].table_left.table) {
                                    $scope.jointures[iJointures].table_left = $scope.tables[iTables];

                                    Object.keys($scope.jointures[iJointures].fieldsLeft).forEach(function (elem) {
                                        if ($scope.jointures[iJointures].fieldsLeft[elem].name == $scope.jointures[iJointures].field_left.name) {
                                            $scope.jointures[iJointures].field_left = $scope.jointures[iJointures].fieldsLeft[elem] ;
                                        }

                                    });
                                }

                                if ($scope.tables[iTables].module == $scope.jointures[iJointures].table_right.module && $scope.tables[iTables].table == $scope.jointures[iJointures].table_right.table) {
                                    $scope.jointures[iJointures].table_right = $scope.tables[iTables];

                                    Object.keys($scope.jointures[iJointures].fieldsRight).forEach(function (elem) {
                                        if ($scope.jointures[iJointures].fieldsRight[elem].name == $scope.jointures[iJointures].field_right.name) {
                                            $scope.jointures[iJointures].field_right = $scope.jointures[iJointures].fieldsRight[elem] ;
                                        }

                                    });
                                }
                            }
                        }
                    }


                    // reconstitue le tableau fields
                    $scope.fields = [];
                    for (var iTables = 0; iTables < $scope.tables.length; iTables++) {
                        $scope.fields.push({
                            table: $scope.tables[iTables].table,
                            fields: $scope.tables[iTables].fields
                        });
                        Object.keys($scope.tables[iTables].fields).forEach(function (elem) {
                            $scope.fieldsGroupAndOrderBy.push({field: $scope.tables[iTables].table + "." + elem});
                        });
                    }

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
                            $scope.tables.push({module: $scope.moduleModelAddTable, table: $scope.tableModalAddTable, fields: response.data.fields});

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

                // Json to array
                var arrAffichage = $.map($scope.affichages, function(el, i) {
                    return el;
                });

                for (var i = 0; i < arrAffichage.length; i++) {

                    if (arrAffichage[i].field == $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField &&
                        arrAffichage[i].operation == $scope.operationModalAddField) {

                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {
                    arrAffichage.push({field: $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField, operation: $scope.operationModalAddField});
                    $scope.affichages = arrAffichage;
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
            $scope.jointures.push({table_left: {}, field_left: {}, type_join: {}, table_right: {}, field_right: {}});
        };


        // Get tables of a module
        $scope.saveRequest = function() {

            var arr_request = [] ;
            var validation = true;

            // Elements of request
            arr_request['tables'] = $scope.tables ;
            arr_request['fields'] = $scope.fields ;
            arr_request['jointures'] = $scope.jointures ;
            arr_request['affichages'] = $scope.affichages ;
            arr_request['conditions'] = $scope.conditions ;
            arr_request['groupsBy'] = $scope.groupsBy ;
            arr_request['ordersBy'] = $scope.ordersBy ;
            arr_request['limits'] = $scope.limits ;
            arr_request['pagination'] = ['Non'] ; // TODO // TODO // TODO // TODO // TODO // TODO // TODO

            var jsonObject = {
                'id' : $scope.id,
                'nom_requete' : $scope.nameRequest,
                'contenu' : Object.assign({}, arr_request)
            };

            if (validation) {
                zhttp.statistics.requetes_generees.save(jsonObject).then(function (response) {
                    if (response.data && response.data !== "false") {
                        if (isNaN(response.data) === false && response.data > 0) {
                            // Insert request is ok => redirect to list
                            $location.path("/ng/com_zeapps_statistics/requetes_generees");
                        }
                    }
                });
            } else {
                alert('Requête invalide, car au moins une des clauses suivantes n\'a pas été renseignée : \r\n - Table(s) \n - Affichage.');
            }

        };


        $scope.getFieldsOfSelectedTableLeft = getFieldsOfSelectedTableLeft;
        function getFieldsOfSelectedTableLeft(table, jointure)
        {
            if (table != null) {
                jointure.fieldsLeft = table.fields;
            }
        }

        $scope.getFieldsOfSelectedTableRight = getFieldsOfSelectedTableRight;
        function getFieldsOfSelectedTableRight(table, jointure)
        {
            if (table != null) {
                jointure.fieldsRight = table.fields;
            }
        }

        $scope.supprimerCetteJointure = supprimerCetteJointure;
        function supprimerCetteJointure(jointure)
        {
            if ($routeParams.id) {

                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, jointure.table_left.table, 'jointure').then(function (response) {
                    for (var i=0; i < $scope.jointures.length; i++) {
                        if ($scope.jointures[i].$$hashKey === jointure.$$hashKey) {
                            $scope.jointures.splice(i, 1);
                            break;
                        }
                    }
                    for (var i=0; i < $scope.affichages.length; i++) {
                        var _table = $scope.affichages[i].field.split(".");
                        if ( _table[0] === jointure.table_left.table) {
                            $scope.affichages.splice(i, 1);
                        }
                    }

                    for (var i=0; i < $scope.conditions.length; i++) {
                        var _table = $scope.conditions[i].field.split(".");
                        if ( _table[0] === jointure.table_left.table) {
                            $scope.conditions.splice(i, 1);
                        }
                    }

                    for (var i=0; i < $scope.groupsBy.length; i++) {
                        var _table = $scope.groupsBy[i].field.split(".");
                        if ( _table[0] === jointure.table_left.table) {
                            $scope.groupsBy.splice(i, 1);
                        }
                    }

                    for (var i=0; i < $scope.ordersBy.length; i++) {
                        var _table = $scope.ordersBy[i].field.split(".");
                        if ( _table[0] === jointure.table_left.table) {
                            $scope.ordersBy.splice(i, 1);
                        }
                    }
                });

                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, jointure.table_right.table, 'jointure').then(function (response) {
                    for (var i=0; i < $scope.jointures.length; i++) {
                        if ($scope.jointures[i].$$hashKey === jointure.$$hashKey) {
                            $scope.jointures.splice(i, 1);
                            break;
                        }
                    }
                    for (var i=0; i < $scope.affichages.length; i++) {
                        var _table = $scope.affichages[i].field.split(".");
                        if ( _table[0] === jointure.table_right.table) {
                            $scope.affichages.splice(i, 1);
                        }
                    }

                    for (var i=0; i < $scope.conditions.length; i++) {
                        var _table = $scope.conditions[i].field.split(".");
                        if ( _table[0] === jointure.table_right.table) {
                            $scope.conditions.splice(i, 1);
                        }
                    }

                    for (var i=0; i < $scope.groupsBy.length; i++) {
                        var _table = $scope.groupsBy[i].field.split(".");
                        if ( _table[0] === jointure.table_right.table) {
                            $scope.groupsBy.splice(i, 1);
                        }
                    }

                    for (var i=0; i < $scope.ordersBy.length; i++) {
                        var _table = $scope.ordersBy[i].field.split(".");
                        if ( _table[0] === jointure.table_right.table) {
                            $scope.ordersBy.splice(i, 1);
                        }
                    }
                });
            }
        }

        $scope.deleteTableFromRequest = deleteTableFromRequest;
        function deleteTableFromRequest(table)
        {
            if ($routeParams.id) {
                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, table.table, 'table').then(function (response) {
                    if (response.data) {
                        if (response.data == 'Element of request deleted') {

                            // Remove data from DOM
                            for (var i=0; i < $scope.tables.length; i++) {
                                if ($scope.tables[i].table === table.table) {
                                    $scope.tables.splice(i, 1);
                                    break;
                                }
                            }

                            for (var i=0; i < $scope.fields.length; i++) {
                                if ($scope.fields[i].table === table.table) {
                                    $scope.fields.splice(i, 1);
                                    break;
                                }
                            }

                            for (var i=0; i < $scope.jointures.length; i++) {
                                if ($scope.jointures[i].table_left.table === table.table || $scope.jointures[i].table_right.table === table.table) {
                                    $scope.jointures.splice(i, 1);
                                    break;
                                }
                            }

                            for (var i=0; i < $scope.affichages.length; i++) {
                                var _table = $scope.affichages[i].field.split(".");
                                if ( _table[0] === table.table) {
                                    $scope.affichages.splice(i, 1);
                                }
                            }

                            for (var i=0; i < $scope.conditions.length; i++) {
                                var _table = $scope.conditions[i].field.split(".");
                                if ( _table[0] === table.table) {
                                    $scope.conditions.splice(i, 1);
                                }
                            }

                            for (var i=0; i < $scope.groupsBy.length; i++) {
                                var _table = $scope.groupsBy[i].field.split(".");
                                if ( _table[0] === table.table) {
                                    $scope.groupsBy.splice(i, 1);
                                }
                            }

                            for (var i=0; i < $scope.ordersBy.length; i++) {
                                var _table = $scope.ordersBy[i].field.split(".");
                                if ( _table[0] === table.table) {
                                    $scope.ordersBy.splice(i, 1);
                                }
                            }

                        } else {
                            alert(response.data);
                            return false;
                        }
                    }
                });
            }
        }

        $scope.deleteAffichageFromRequest = deleteAffichageFromRequest;
        function deleteAffichageFromRequest(affichage)
        {
            if ($routeParams.id) {
                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, affichage.field, 'affichage').then(function (response) {
                    if (response.data) {
                        if (response.data == 'Element of request deleted') {

                            // Remove data from DOM
                            var arrAffichages = $.map($scope.affichages, function(el, i) {
                                return el;
                            });

                            for (var i=0; i < arrAffichages.length; i++) {
                                if ( arrAffichages[i].field === affichage.field) {
                                    arrAffichages.splice(i, 1);
                                }
                            }

                            $scope.affichages = arrAffichages;

                        } else {
                            alert(response.data);
                            return false;
                        }
                    }
                });
            }
        }

        $scope.deleteConditionFromRequest = deleteConditionFromRequest;
        function deleteConditionFromRequest(condition)
        {
            if ($routeParams.id) {
                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, condition.field, 'condition').then(function (response) {
                    if (response.data) {
                        if (response.data == 'Element of request deleted') {

                            // Remove data from DOM => Transfet de Json vers array pour le "splice"
                            var arrConditions = $.map($scope.conditions, function(el, i) {
                                return el;
                            });

                            for (var i=0; i < arrConditions.length; i++) {
                                if ( arrConditions[i].field === condition.field) {
                                    arrConditions.splice(i, 1);
                                }
                            }

                            $scope.conditions = arrConditions;

                        } else {
                            alert(response.data);
                            return false;
                        }
                    }
                });
            }
        }

        $scope.deleteGroupByFromRequest = deleteGroupByFromRequest;
        function deleteGroupByFromRequest(GroupBy)
        {
            if ($routeParams.id) {
                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, GroupBy.field, 'groupBY').then(function (response) {
                    if (response.data) {
                        if (response.data == 'Element of request deleted') {

                            // Remove data from DOM
                            var arrGroupsBy = $.map($scope.groupsBy, function(el, i) {
                                return el;
                            });

                            for (var i=0; i < arrGroupsBy.length; i++) {
                                if ( arrGroupsBy[i].field === GroupBy.field) {
                                    arrGroupsBy.splice(i, 1);
                                }
                            }

                            $scope.groupsBy = arrGroupsBy;

                        } else {
                            alert(response.data);
                            return false;
                        }
                    }
                });
            }
        }

        $scope.deleteOrderByFromRequest = deleteOrderByFromRequest;
        function deleteOrderByFromRequest(OrderBy)
        {
            if ($routeParams.id) {
                zhttp.statistics.requetes_generees.deleteElement($routeParams.id, OrderBy.field, 'orderBy').then(function (response) {
                    if (response.data) {
                        if (response.data == 'Element of request deleted') {

                            // Remove data from DOM
                            var arrOrdersBy = $.map($scope.ordersBy, function(el, i) {
                                return el;
                            });

                            for (var i=0; i < arrOrdersBy.length; i++) {
                                if ( arrOrdersBy[i].field === OrderBy.field) {
                                    arrOrdersBy.splice(i, 1);
                                }
                            }

                            $scope.ordersBy = arrOrdersBy;

                        } else {
                            alert(response.data);
                            return false;
                        }
                    }
                });
            }
        }

        $scope.back = back;
        function back()
        {
            $location.path("/ng/com_zeapps_statistics/requetes_generees");
        }


}]);