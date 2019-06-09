$(document).ready(function () {

    $('#after-event.success').modal('toggle');
    $('#after-event .close, #after-event .close-button').click(function (e) { 
        $('#after-event').removeClass('success');
    });

    $('.table-admin').DataTable({
        "lengthMenu": [5, 10, 25, 50, 75, 100],
        "pageLength": 5,
        "ordering": false, // supprime la possibilité de trier les entrées
        "info": false,
        "language": {
            "lengthMenu": "Afficher  _MENU_  entrées",
            "zeroRecords": "La recherche n'a donné aucun résultat",
            "info": "Afficher page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucune entrée trouvée",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Rechercher :",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédant"
            },
        }
    });
    $('.dataTables_length').addClass('bs-select');
    $('.pagination').addClass('pagination-custom'); // add CSS to the table
});