<div id="breadcrumb">
    Liste des requêtes
</div>
<div id="content">

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6" style="padding-top: 5px">
                <span class="fa fa-filter pull-left" style="font-size: 24px"></span> <ze-filters class="pull-left" data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>
            </div>

            <div class="col-md-6">

            </div>

        </div>
    </div>

    <div class="row" style="margin-top: 12px">
        <div class="col-md-12">
            <table class="table table-hover table-condensed table-responsive" ng-show="requetesGenerees.length">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-1">Nom requête</th>
                        {{--<th class="col-md-4">Contenu</th>--}}
                        <th class="col-md-1">Date création</th>
                        <th class="col-md-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="requeteGeneree in requetesGenerees" style="cursor: pointer" class="open-modalEditRequet">

                        <td>@{{requeteGeneree.id}}</td>
                        <td>@{{requeteGeneree.nom_requete}}</td>
                        {{--<td>@{{requeteGeneree.contenu}}</td>--}}
                        <td>@{{requeteGeneree.created_at || "-" | date:'dd/MM/yyyy'}}</td>
                        <td class="text-left">
                            <button title="Modifier" class="bg-info" ng-click="edit(requeteGeneree.id)" >
                                <span class="fa fa-pencil"></span>
                            </button>
                            <button title="Exécuter" class="bg-primary" ng-click="execute(requeteGeneree)">
                                <span class="fa fa-spinner"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="modal" id="modalExecuteRequest" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" style="width: 800px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="breadcrumb"><span class="fa fa-spinner"></span> Exécution requête
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    Voulez-vous vraiment exécuter cette requête ?
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" >Non</button>
                            <button type="button" class="btn btn-success" ng-click="execute(id)">Oui</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                $(document).ready(function() {
                    $(this).on("click", ".open-modalExecuteRequest", function () {

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

            <script type="text/css">
                table > thead > th, table > tbody > tr > td {
                    text-align: center;
                }
            </script>

        </div>
    </div>

</div>