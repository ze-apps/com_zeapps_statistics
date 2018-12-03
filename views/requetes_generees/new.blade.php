<div id="breadcrumb">
    Générateur de requêtes
</div>

<div id="content">

    <!-----------
        TABLES
     ----------->

    <div class="row" style="margin-top: 10px; margin-bottom: 10px">
        <div class="col-md-12">
            <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Table(s)
                <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalTable" hint="Ajouter" always-on="true"
                        href="#modalTable" data-toggle="modal" ></ze-btn>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="tblTables" class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-6">Module</th>
                        <th class="col-md-6">Table</th>
                    </tr>
                </thead>
                <tbody>
                <tr ng-repeat="table in tables">
                    <td>@{{ table.module }}</td>
                    <td>@{{ table.table }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!------------
       JOINTURE
     ------------->

    <div ng-if="tables.length >= 2">

        <div class="row" style="margin-top: 10px; margin-bottom: 10px">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Jointure(s)
                    <div class="pull-right">
                        <button type="button" class="btn btn-success btn-xs" ng-click="addJointure()"><span class="fa fa-plus"></span> Ajouter</button>
                    </div>
                </h4>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12" id="divJointure">

                <div class="row" style="margin-bottom: 10px;" ng-repeat="jointure in jointures">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <select ng-model="table1.table" class="form-control" ng-change="getFieldsOfSelectedTableLeft(table1.table)" ng-options="table1.table for table1 in tables">
                            <option value="">-- sélectonnez une table --</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <select ng-model="field1.name" class="form-control" ng-options="field1.name for field1 in fieldsLeft" >
                            <option value="">-- sélectonnez un champ --</option>
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0" >
                        <select class="form-control" id="operateurJointure_' + nbJointures + '">
                            <option>INNER JOIN</option>
                            <option>CROSS JOIN</option>
                            <option selected>LEFT JOIN</option>
                            <option>RIGHT JOIN</option>
                            <option>FULL JOIN</option>
                            <option>SELF JOIN</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <select ng-model="table2.table" class="form-control" ng-change="getFieldsOfSelectedTableRight(table2.table)" ng-options="table2.table for table2 in tables">
                            <option value="">-- sélectonnez une table --</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <select ng-model="field2.name" class="form-control" ng-options="field2.name for field2 in fieldsRight" >
                            <option value="">-- sélectonnez un champ --</option>
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-12" style="text-align: center; padding-top: 5px">
                        <span ng-click="supprimerCetteJointure(jointure)" class="fa fa-remove text-danger center-block" style="font-size: 25px; cursor: pointer" title="Retirer"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!------------
       AFFICHAGE
     ------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Affichage
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalAffichage" hint="Ajouter" always-on="true"
                            href="#modalAffichage" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-6">Champs</th>
                        <th class="col-md-6">Opération</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.nom</td>
                        <td>MIN ( )</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.ville</td>
                        <td>MAX ( )</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.pays</td>
                        <td>AVG ( )</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_crm.Devis.numero</td>
                        <td>SUM ( )</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_crm.Devis.montant</td>
                        <td>SUM ( )</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--------------
       CONDITION(S)
     --------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Condition(s)
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalCondition" hint="Ajouter" always-on="true"
                            href="#modalCondition" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-5">Champs</th>
                        <th class="col-md-2">Opération</th>
                        <th class="col-md-5">Valeur / intervalle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.nom</td>
                        <td>IN</td>
                        <td>(FRANCE, ITALIE, ESPAGNE)</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.ville</td>
                        <td>IN</td>
                        <td>(NANTES, PARIS, MARSEILLE)</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.montant</td>
                        <td>></td>
                        <td>1000</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.date_creation</td>
                        <td>BETWEEN</td>
                        <td>01/01/2018 - 31/01/2018</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--------------
       Groupé par
     --------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Groupé par
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalGroupePar" hint="Ajouter" always-on="true"
                            href="#modalGroupePar" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Champs</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.nom</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.ville</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.montant</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--------------
       Ordonné par
     --------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Ordonné par
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalOrdonnePar" hint="Ajouter" always-on="true"
                            href="#modalOrdonnePar" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-8">Champs</th>
                        <th class="col-md-4">Sens</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.nom</td>
                        <td>ASC</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.ville</td>
                        <td>ASC</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_contact.Entreprise.montant</td>
                        <td>DESC</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!------------
         LIMIT
     ------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Limit
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalLimit" hint="Ajouter" always-on="true"
                            href="#modalLimit" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                    <tr ng-repeat="limit in limits">
                        <th class="col-md-12">Valeur</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="limit in limits">
                        <td>1, 10</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!------------------
         PAGINATION
     ------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Pagination</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 pull-left">
                    <input type="radio" value="non" checked id="paginationNon" name="pagination" /> <label style="margin-right: 15px" for="paginationNon">Non</label>
                    <input type="radio" value="oui" id="paginationOui" name="pagination" /> <label for="paginationOui">Oui</label>
                </div>
            </div>
        </div>
    </div>


    <div class="row pull-right" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="col-md-12">
            <button class="btn btn-danger" style="width: 150px">Annuler</button>
            <button class="btn btn-success" style="width: 150px">Valider</button>
        </div>
    </div>


    <!-- **************************************************************************
                                        MODALS
     ************************************************************************** -->

    <div class="modal" id="modalTable" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvelle table
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Module</strong>
                            </div>
                            <div class="col-md-8">
                                <select id="selectModule" ng-class="moduleModelAddTable==null||moduleModelAddTable==''?'errorSelect form-control':'form-control'" ng-options="module for module in moduleTables" ng-model="moduleModelAddTable" ng-change="loadTables(moduleModelAddTable)">
                                    <option value="">-- Sélectionner le module --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select id="selectTable" ng-class="tableModalAddTable==null||tableModalAddTable==''?'errorSelect form-control':'form-control'" ng-options="table.sqlName as table.sqlName for table in tablesToAdd" ng-model="tableModalAddTable" >
                                    <option value="">-- Sélectionner la table --</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="btnAddTables" ng-click="addTable()" >Valider</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal" id="modalAffichage" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvel affichage
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option selected>com_zeapps_contact.Entreprise</option>
                                    <option>com_zeapps_contact.Devis</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option selected>com_zeapps_contact.Entreprise.nom</option>
                                    <option>com_zeapps_contact.Entreprise.ville</option>
                                    <option>com_zeapps_contact.Entreprise.pays</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Opération</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option selected>Aucune opération</option>
                                    <option>COUNT ( )</option>
                                    <option>MIN ( )</option>
                                    <option>MAX ( )</option>
                                    <option>SUM ( )</option>
                                    <option>AVG ( )</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <div class="modal" id="modalCondition" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvelle condition
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option>com_zeapps_contact.Entreprise</option>
                                    <option selected>com_zeapps_contact.Devis</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option selected>com_zeapps_crm.Devis.designation</option>
                                    <option selected>com_zeapps_crm.Devis.numero</option>
                                    <option>com_zeapps_crm.Devis.total_ht</option>
                                    <option>com_zeapps_crm.Devis.total_ttc</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Opération</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option>=</option>
                                    <option>></option>
                                    <option><</option>
                                    <option>>=</option>
                                    <option><=</option>
                                    <option>IN</option>
                                    <option>BETWEEN</option>
                                    <option>LIKE %valeur</option>
                                    <option>LIKE valeur%</option>
                                    <option>LIKE %valeur%</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Valeur / Intervalle</strong>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="" required />
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <div class="modal" id="modalGroupePar" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouveau champ de groupement
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">

                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>

                            <div class="col-md-8">
                                <select class="form-control">
                                    <option>com_zeapps_contact.Entreprise.pays</option>
                                    <option selected>com_zeapps_crm.Devis.numero</option>
                                    <option>com_zeapps_crm.Devis.montant</option>
                                    <option>com_ze_apps_contact.Entreprise.date_creation</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <div class="modal" id="modalOrdonnePar" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouveau champ de tri
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">

                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>

                            <div class="col-md-8">
                                <select class="form-control">
                                    <option>com_zeapps_contact.Entreprise.pays</option>
                                    <option selected>com_zeapps_crm.Devis.numero</option>
                                    <option>com_zeapps_crm.Devis.montant</option>
                                    <option>com_ze_apps_contact.Entreprise.date_creation</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">

                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Sens</strong>
                            </div>

                            <div class="col-md-8">
                                <select class="form-control">
                                    <option selected>ASC</option>
                                    <option>DESC</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <div class="modal" id="modalLimit" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvelle limite
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Valeur</strong>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="" required placeholder="Ex : 5, 10" />
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!---------------
        JAVASCRIPT
     ---------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>

    <script type="text/javascript">

        // var tables = [];
        //
        // function supprimerCetteJointure(id_span_jointure)
        // {
        //     console.log(id_span_jointure);
        //     $('div#jointure_'+id_span_jointure).remove();
        //     /*if (nbJointures >= 1) {
        //         nbJointures--;
        //     }*/
        // }
        //
        // // Tables currently added
        // function getOptionsSelectsTables()
        // {
        //     var html_tables = '';
        //     tables.forEach(function (elem) {
        //         html_tables += '<option>' + elem + '</option>';
        //     });
        //     return html_tables;
        // }
        //
        // function getFieldsOfSelectedTable(id_select)
        // {
        //     /*
        //     var nom_table_selectionnee = $('#'+id_select+' :selected').text();
        //     console.log(nom_table_selectionnee);
        //
        //     $("#selectHiddenTables option").each(function()
        //     {
        //         if ($(this).text() == nom_table_selectionnee) {
        //             console.log($(this).bind().innerHTML);
        //         }
        //         // console.log($(this).val());
        //         // console.log($(this).bind());
        //     });*/
        // }
        //
        // $(document).ready(function() {
        //
        //     $(this).on("click", ".open-modalAffichage", function () {
        //
        //     });
        //
        //     $(this).on("click", ".open-modalCondition", function () {
        //
        //     });
        //
        //     $(this).on("click", ".open-modalGroupePar", function () {
        //
        //     });
        //
        //     $(this).on("click", ".open-modalOrdonnePar", function () {
        //
        //     });
        //
        // });

    </script>

    <!-------------
          CSS
    --------------->
    <script type="text/css">

    </script>

    <style>
        .errorSelect {
            border: 1px solid red ;
        }
    </style>

</div>