
<div ng-controller="ComZeappsSocaCommandeTraitementCtrl">

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 ">
                        <strong>Date commande</strong> <span class="pull-right">:</span>
                    </div>
                    <div class="col-md-6 ">
                        01/11/2018
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 ">
                        <strong>Client</strong> <span class="pull-right">:</span>
                    </div>
                    <div class="col-md-6 ">
                        M. Martin DUGLAS
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 ">
                        <strong>Contact</strong> <span class="pull-right">:</span>
                    </div>
                    <div class="col-md-6 ">
                        M. Didier DESCHAMPS
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 ">
                        <strong>Objet</strong> <span class="pull-right">:</span>
                    </div>
                    <div class="col-md-6 ">
                        Vente de chaises et tables
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 ">
                        <strong>Date livraison</strong> <span class="pull-right">:</span>
                    </div>
                    <div class="col-md-6 ">
                        21/12/2018
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
                            <td>08/11/2018</td>
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
                            <td>08/11/2018</td>
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
                            <td>08/11/2018</td>
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
                            <td>08/11/2018</td>
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
                            <td>08/11/2018</td>
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
                '<button class="btn btn-info btn-md text-center" onclick="location.reload()" style="width: 100%" type="button" ng-click="save()" ng-disabled=\'form.zeapps_modal_form_isvalid != undefined && !form.zeapps_modal_form_isvalid\' ng-hide="form.zeapps_modal_hide_save_btn">Lancer la production</button>' +
                '</div>');

        </script>

    </div>

</div>
