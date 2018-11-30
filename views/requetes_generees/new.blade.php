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

                </tbody>
            </table>
        </div>
    </div>

    <!------------
       JOINTURE
     ------------->

    <div class="row" style="margin-top: 10px; margin-bottom: 10px">
        <div class="col-md-12">
            <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Jointure(s)
                <div class="pull-right">
                    <ze-btn id="ajoutJointure" fa="plus"  color="success" hint="Ajouter" always-on="true"></ze-btn>
                </div>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" id="divJointure">
            <!-- Dynamic javascript code here -->
        </div>
    </div>

    <!------------
       AFFICHAGE
     ------------->

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

    <!--------------
       CONDITION(S)
     --------------->

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

    <!--------------
       Groupé par
     --------------->

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

    <!--------------
       Ordonné par
     --------------->

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

    <!------------
         LIMIT
     ------------->

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


    <!------------------
         PAGINATION
     ------------------->

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
                                <select id="selectModule" class="form-control" ng-options="module for module in modules" ng-model="module" ng-change="loadTables(module)">
                                    <option value="">-- sélectionnez un module --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select id="selectTable" class="form-control" ng-options="table.sqlName as table.sqlName for table in tables" ng-model="table" ng-value="@{{table.fields}}" >
                                    <option value="">-- sélectonnez une table --</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="btnAddTables" >Valider</button>
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

        var nbJointures = 0;
        var tables = [];

        function supprimerCetteJointure(id_span_jointure)
        {
            $('div#jointure_'+id_span_jointure).remove();
            if (nbJointures >= 1) {
                nbJointures--;
            }
        }

        // Tables currently added
        function getOptionsSelectsTables()
        {
            var html_tables = '';
            tables.forEach(function (elem) {
                html_tables += '<option>' + elem + '</option>';
            });
            return html_tables;
        }

        $(document).ready(function() {

            console.log($('#selectTable').attr('name'));

            $(this).on("click", ".open-modalTable", function () {

                // Validation of 2 selects
                $('#btnAddTables').click(function(e) {

                    e.preventDefault();

                    if ($( "#selectModule option:selected" ).val() == '' || $( "#selectTable option:selected" ).val() == '') {

                        if ($( "#selectModule option:selected" ).val() == '') {
                            $( "#selectModule" ).attr('style', 'border: 1px solid red');
                        } else {
                            $( "#selectModule" ).attr('style', 'border: 1px solid #ccc');
                        }

                        if ($( "#selectTable option:selected" ).val() == '') {
                            $( "#selectTable" ).attr('style', 'border: 1px solid red');
                        } else {
                            $( "#selectTable" ).attr('style', 'border: 1px solid #ccc');
                        }

                        return false;

                    } else {

                        $( "#selectModule" ).attr('style', 'border: 1px solid #ccc');
                        $( "#selectTable" ).attr('style', 'border: 1px solid #ccc');

                        // Add tables and modules to current page (DOM only)
                        var module = $("#selectModule option:selected").val();
                        var table = $("#selectTable option:selected").val();

                        // Supprimer 'string:'
                        module = module.replace('string:', '');
                        table = table.replace('string:', '');

                        // Close modal and append data
                        $('#modalTable').modal('hide');

                        if ($('table#tblTables tbody').html().indexOf('<tr><td>' + module + '</td><td>' + table + '</td></tr>') == -1) {
                            $('table#tblTables tbody').append('<tr><td>' + module + '</td><td>' + table + '</td></tr>');
                            tables.push(table);
                            var options = getOptionsSelectsTables();

                            for(var i=1; i<=nbJointures; i++) {
                                $('#tableGauche_'+i).empty();
                                $('#tableDroite_'+i).empty();
                                $('#tableGauche_'+i).append(options);
                                $('#tableDroite_'+i).append(options);
                            }
                        }

                        return true;
                    }

                });

            });

            $('#ajoutJointure').click(function () {

                if (tables.length > 0) {

                    nbJointures++;

                    $('div#divJointure').append('<div class="row" id="jointure_' + nbJointures + '" style="margin-bottom: 10px; ">\n' +
                        '                <div class="col-md-3 col-sm-6 col-xs-12">\n' +
                        '                    <select ng-model="table" class="form-control" id="tableGauche_' + nbJointures + '">\n' +
                        '                        <option value="">-- sélectonnez une table --</option>\n' +
                                                 getOptionsSelectsTables() +
                        '                    </select>\n' +
                        '                </div>\n' +
                        '                <div class="col-md-2 col-sm-6 col-xs-12">\n' +
                        '                    <select ng-model="module" class="form-control" id="champGauche_' + nbJointures + '">\n' +
                        '                    </select>\n' +
                        '                </div>\n' +
                        '                <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0" >\n' +
                        '                    <select class="form-control" id="operateurJointure_' + nbJointures + '">\n' +
                        '                        <option>INNER JOIN</option>\n' +
                        '                        <option>CROSS JOIN</option>\n' +
                        '                        <option selected>LEFT JOIN</option>\n' +
                        '                        <option>RIGHT JOIN</option>\n' +
                        '                        <option>FULL JOIN</option>\n' +
                        '                        <option>SELF JOIN</option>\n' +
                        '                    </select>\n' +
                        '                </div>\n' +
                        '                <div class="col-md-3 col-sm-6 col-xs-12">\n' +
                        '                    <select class="form-control" id="tableDroite_' + nbJointures + '">\n' +
                        '                        <option value="">-- sélectonnez une table --</option>\n' +
                                                 getOptionsSelectsTables() +
                        '                    </select>\n' +
                        '                </div>\n' +
                        '                <div class="col-md-2 col-sm-6 col-xs-12">\n' +
                        '                    <select class="form-control" id="champDroite_' + nbJointures + '"  >\n' +
                        '                    </select>\n' +
                        '                </div>\n' +
                        '                <div class="col-md-1 col-sm-6 col-xs-12" style="text-align: center; padding-top: 5px">\n' +
                        '                    <span onclick="supprimerCetteJointure(' + nbJointures + ');" class="fa fa-remove text-danger center-block" style="font-size: 25px; cursor: pointer" title="Retirer"></span>\n' +
                        '                </div>\n' +
                        '            </div>');

                    $('#tableGauche_' + nbJointures).change(function() {
                        if ($(this).find(':selected').val() != '') {

                        }
                    });


                } else {

                    alert('Vous devez ajouter au moins 2 tables pour ajouter une jointure.')

                }

            });

            $(this).on("click", ".open-modalAffichage", function () {

            });

            $(this).on("click", ".open-modalCondition", function () {

            });

            $(this).on("click", ".open-modalGroupePar", function () {

            });

            $(this).on("click", ".open-modalOrdonnePar", function () {

            });

        });

    </script>

    <!-------------
          CSS
    --------------->
    <script type="text/css">

    </script>

</div>