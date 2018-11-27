<div id="breadcrumb">
    Générateur de requêtes
</div>

<div id="content">

    <!--------
       TABLE
     --------->

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
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-6">Module</th>
                        <th class="col-md-6">Table</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>com_ze_apps_contact</td>
                        <td>Entreprise</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_crm</td>
                        <td>Devis</td>
                    </tr>
                    <tr>
                        <td>com_ze_apps_crm</td>
                        <td>Devis_ligne</td>
                    </tr>
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
                    <ze-btn id="ajoutJointure" fa="plus" color="success" hint="Ajouter" always-on="true"></ze-btn>
                </div>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" id="divJointure">
            <div class="row" id="jointure_1" style="margin-bottom: 10px; ">

                <div class="col-md-2 col-sm-6 col-xs-12">
                    <select class="form-control" id="tableGauche_1">
                        <option selected>com_zeapps_crm_quotes</option>
                        <option>com_zeapps_crm_quote_lines</option>
                        <option>com_zeapps_contact_companies</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <select class="form-control" id="champGauche_1">
                        <option>id</option>
                        <option>libelle</option>
                        <option>numerotation</option>
                        <option>status</option>
                        <option>probability</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <select class="form-control" id="operateurJointure_1">
                        <option>INNER JOIN</option>
                        <option>CROSS JOIN</option>
                        <option selected>LEFT JOIN</option>
                        <option>RIGHT JOIN</option>
                        <option>FULL JOIN</option>
                        <option>SELF JOIN</option>
                        <option>NATURAL JOIN</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <select class="form-control" id="tableDroite_1">
                        <option>com_zeapps_crm_quotes</option>
                        <option selected>com_zeapps_crm_quote_lines</option>
                        <option>com_zeapps_contact_companies</option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12">
                    <select class="form-control" id="champDroite_1"  >
                        <option>id_quote</option>
                        <option>type</option>
                        <option>ref</option>
                        <option>designation_title</option>
                        <option>designation_desc</option>
                    </select>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-12" style="text-align: center; padding-top: 5px">
                    <span onclick="supprimerCetteJointure(1);" class="fa fa-remove text-danger center-block" style="font-size: 25px; cursor: pointer" title="Retirer"></span>
                </div>

            </div>
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
                        </button></h4>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Module</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option>com_zeapps_crm_quotes</option>
                                    <option selected>com_zeapps_crm_quote_lines</option>
                                    <option>com_zeapps_contact_companies</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control">
                                    <option>Entreprise</option>
                                    <option selected>Devis</option>
                                    <option>Devis_ligne</option>
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

    <!---------------
        JAVASCRIPT
     ---------------->

    <script type="text/javascript">

        function supprimerCetteJointure(id_span_jointure) {
            $('div#jointure_'+id_span_jointure).remove();
            if (nbJointures>=1) {
                nbJointures--;
            }
        }

        var nbJointures = 1;

        $(document).ready(function() {

            $(this).on("click", ".open-modalTable", function () {

            });

            $('#ajoutJointure').click(function () {
                nbJointures++;
                $('div#divJointure').append('<div class="row" id="jointure_'+nbJointures+'" style="margin-bottom: 10px; ">\n' +
                    '\n' +
                    '                <div class="col-md-2 col-sm-6 col-xs-12">\n' +
                    '                    <select class="form-control" id="tableGauche_'+nbJointures+'">\n' +
                    '                        <option selected>com_zeapps_crm_quotes</option>\n' +
                    '                        <option>com_zeapps_crm_quote_lines</option>\n' +
                    '                        <option>com_zeapps_contact_companies</option>\n' +
                    '                    </select>\n' +
                    '                </div>\n' +
                    '                <div class="col-md-2 col-sm-6 col-xs-12">\n' +
                    '                    <select class="form-control" id="champGauche_'+nbJointures+'">\n' +
                    '                        <option>id</option>\n' +
                    '                        <option>libelle</option>\n' +
                    '                        <option>numerotation</option>\n' +
                    '                        <option>status</option>\n' +
                    '                        <option>probability</option>\n' +
                    '                    </select>\n' +
                    '                </div>\n' +
                    '                <div class="col-md-3 col-sm-12 col-xs-12">\n' +
                    '                    <select class="form-control" id="operateurJointure_'+nbJointures+'">\n' +
                    '                        <option>INNER JOIN</option>\n' +
                    '                        <option>CROSS JOIN</option>\n' +
                    '                        <option selected>LEFT JOIN</option>\n' +
                    '                        <option>RIGHT JOIN</option>\n' +
                    '                        <option>FULL JOIN</option>\n' +
                    '                        <option>SELF JOIN</option>\n' +
                    '                        <option>NATURAL JOIN</option>\n' +
                    '                    </select>\n' +
                    '                </div>\n' +
                    '                <div class="col-md-2 col-sm-6 col-xs-12">\n' +
                    '                    <select class="form-control" id="tableDroite_'+nbJointures+'">\n' +
                    '                        <option>com_zeapps_crm_quotes</option>\n' +
                    '                        <option selected>com_zeapps_crm_quote_lines</option>\n' +
                    '                        <option>com_zeapps_contact_companies</option>\n' +
                    '                    </select>\n' +
                    '                </div>\n' +
                    '                <div class="col-md-2 col-sm-6 col-xs-12">\n' +
                    '                    <select class="form-control" id="champDroite_'+nbJointures+'"  >\n' +
                    '                        <option>id_quote</option>\n' +
                    '                        <option>type</option>\n' +
                    '                        <option>ref</option>\n' +
                    '                        <option>designation_title</option>\n' +
                    '                        <option>designation_desc</option>\n' +
                    '                    </select>\n' +
                    '                </div>\n' +
                    '                <div class="col-md-1 col-sm-6 col-xs-12" style="text-align: center; padding-top: 5px">\n' +
                    '                    <span onclick="supprimerCetteJointure('+nbJointures+');" class="fa fa-remove text-danger center-block" style="font-size: 25px; cursor: pointer" title="Retirer"></span>\n' +
                    '                </div>\n' +
                    '\n' +
                    '            </div>');

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