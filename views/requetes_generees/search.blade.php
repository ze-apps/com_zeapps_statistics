<div id="breadcrumb">
    Liste des requêtes
</div>
<div id="content">

    <div class="row">
        <div class="col-md-12">

            {{--<ze-filters class="pull-right" data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>--}}

            <div class="col-md-6">
                <label>Filtre : </label>
                <select>
                    <option selected>Tous</option>
                    <option>Valeur1</option>
                    <option>Valeur2</option>
                    <option>Valeur3</option>
                </select>
            </div>

            <div class="col-md-6">
                <ze-btn class="pull-right" fa="download" color="success" hint="Excel" always-on="true"
                        ng-click="getExcel()"></ze-btn>
            </div>

        </div>
    </div>

    <div class="row" style="margin-top: 12px">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-responsive" ng-show="commandes.length">
                <thead>
                    <tr>
                        <th class="col-md-1">Date</th>
                        <th class="col-md-1">#</th>
                        <th class="col-md-2">Client</th>
                        <th class="col-md-4">Objet</th>
                        <th class="col-md-1">Nb Articles</th>
                        <th class="col-md-2">Commercial</th>
                        <th class="col-md-1">Date livraison</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="commande in commandes" style="cursor: pointer" class="open-modalTraitement"

                        data-id="@{{commande.id}}"
                        data-date-commande="@{{commande.date}}"
                        data-client="@{{commande.client}}"
                        data-contact="@{{commande.commercial}}"
                        data-objet="@{{commande.objet}}"
                        data-date-livraison="@{{commande.date_livraison}}"


                        data-target="#modalTraitement"
                        data-toggle="modal">

                        <td>@{{commande.date}}</td>
                        <td>@{{commande.numero}}</td>
                        <td>@{{commande.client}}</td>
                        <td>@{{commande.objet}}</td>
                        <td>@{{commande.nb_articles}}</td>
                        <td>@{{commande.commercial}}</td>
                        <td>@{{commande.date_livraison}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="modal" id="modalTraitement" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4 ">
                                                <strong>Date commande</strong> <span class="pull-right">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <span id="date_commande"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4 ">
                                                <strong>Client</strong> <span class="pull-right">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <span id="client"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4 ">
                                                <strong>Contact</strong> <span class="pull-right">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <span id="contact"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4 ">
                                                <strong>Objet</strong> <span class="pull-right">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <span id="objet"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4 ">
                                                <strong>Date livraison</strong> <span class="pull-right">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <span class="date_livraison"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 20px">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <table class="table table-condensed table-bordered table-responsive">
                                            <thead>
                                            <tr style="background-color: whitesmoke">
                                                <th class="col-md-1">Réf.</th>
                                                <th class="col-md-6">Article</th>
                                                <th class="col-md-1">Quantité</th>
                                                <th class="col-md-2">Date livraison</th>
                                                <th class="col-md-2">Plan de production</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2891178</td>
                                                    <td>Chaise Café Marly</td>
                                                    <td>37</td>
                                                    <td><span class="date_livraison"></span></td>
                                                    <td>
                                                        <select class="form-control" style="height: 22px">
                                                            <option>Plan 1</option>
                                                            <option>Plan 2</option>
                                                            <option selected>Plan 3</option>
                                                            <option>Plan 4</option>
                                                            <option>Plan 5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>9874560</td>
                                                    <td>Fauteuil Frizz</td>
                                                    <td>17</td>
                                                    <td><span class="date_livraison"></span></td>
                                                    <td>
                                                        <select class="form-control" style="height: 22px">
                                                            <option>Plan 1</option>
                                                            <option>Plan 2</option>
                                                            <option>Plan 3</option>
                                                            <option>Plan 4</option>
                                                            <option selected>Plan 5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2757901</td>
                                                    <td>Fauteuil Karavel</td>
                                                    <td>38</td>
                                                    <td><span class="date_livraison"></span></td>
                                                    <td>
                                                        <select class="form-control" style="height: 22px">
                                                            <option>Plan 1</option>
                                                            <option>Plan 2</option>
                                                            <option selected>Plan 3</option>
                                                            <option>Plan 4</option>
                                                            <option>Plan 5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4004287</td>
                                                    <td>Fauteuil Tracks Magic Window</td>
                                                    <td>6</td>
                                                    <td><span class="date_livraison"></span></td>
                                                    <td>
                                                        <select class="form-control" style="height: 22px">
                                                            <option>Plan 1</option>
                                                            <option selected>Plan 2</option>
                                                            <option>Plan 3</option>
                                                            <option>Plan 4</option>
                                                            <option>Plan 5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3474055</td>
                                                    <td>Guéridon Karla Mazoo</td>
                                                    <td>10</td>
                                                    <td><span class="date_livraison"></span></td>
                                                    <td>
                                                        <select class="form-control" style="height: 22px">
                                                            <option>Plan 1</option>
                                                            <option>Plan 2</option>
                                                            <option>Plan 3</option>
                                                            <option>Plan 4</option>
                                                            <option selected>Plan 5</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <script type="text/javascript">

                                    $('#next_raise').datepicker({
                                        uiLibrary: 'bootstrap',
                                        altField: "#next_raise",
                                        closeText: 'Fermer',
                                        prevText: 'Précédent',
                                        nextText: 'Suivant',
                                        currentText: 'Aujourd\'hui',
                                        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
                                        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                                        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
                                        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                                        weekHeader: 'Sem.',
                                        dateFormat: 'dd/mm/yy'
                                    });

                                    $('div.modal-header').empty();
                                    $('div.modal-header').append('<div id="breadcrumb">Soca : Traiter une commande</div>');

                                    $('div.modal-footer').empty();
                                    $('div.modal-footer').append('<div class="col-md-offset-4 col-md-4">' +
                                        '<a class="btn btn-info btn-md text-center" target="_self" id="lancerProduction" style="width: 100%" >Lancer la production</a>' +
                                        '</div>');

                                </script>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                $(document).ready(function() {
                    $(this).on("click", ".open-modalTraitement", function () {

                        var idCommande = $(this).data('id');
                        var dateCommande = $(this).data('date-commande');
                        var client = $(this).data('client');
                        var contact = $(this).data('contact');
                        var objet = $(this).data('objet');
                        var date_livraison = $(this).data('date-livraison');

                        $('#date_commande').empty();
                        $('#client').empty();
                        $('#contact').empty();
                        $('#objet').empty();
                        $('.date_livraison').empty();

                        $('#date_commande').append(dateCommande);
                        $('#client').append(client);
                        $('#contact').append(contact);
                        $('#objet').append(objet);
                        $('.date_livraison').append(date_livraison);

                        $('#lancerProduction').attr('href', 'http://zeapps/ng/com_zeapps_statistics/commandes/' + idCommande);
                    });
                });

            </script>

        </div>
        <div class="col-md-offset-4 col-md-4 text-center">
            <a href="#" title="Page précédente"><i class="fa fa-chevron-left"></i></a>
                <a href="#">1</a> <strong><u>2</u></strong> <a href="#">3</a> <a href="#">4</a>
            <a href="#" title="Page suivante"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div>

</div>