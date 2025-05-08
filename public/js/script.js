$(document).ready(function() {
    // Initialisation de DataTables avec traduction FR
    var table = $('#mytable').DataTable({
        "language": {
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "sInfoEmpty": "Affichage de 0 à 0 sur 0 entrées",
            "sInfoFiltered": "(filtré à partir de _MAX_ entrées au total)",
            "sLengthMenu": "Afficher _MENU_ entrées",
            "sLoadingRecords": "Chargement...",
            "sProcessing": "Traitement...",
            "sSearch": "Rechercher :",
            "sZeroRecords": "Aucun résultat trouvé",
            "oPaginate": {
                "sFirst": "Premier",
                "sPrevious": "Précédent",
                "sNext": "Suivant",
                "sLast": "Dernier"
            }
        }
    });

    // Ajout du filtre personnalisé
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();

        // Si pas de filtre appliqué, afficher tout
        if (!startDate && !endDate) {
            return true;
        }

        var dateDebutStr = data[2]; // Ex: "01/05/2025"
        var dateFinStr = data[3];

        // Fonction utilitaire pour convertir "jj/mm/aaaa" → objet Date
        function parseDate(str) {
            var parts = str.split('/');
            return new Date(parts[2], parts[1] - 1, parts[0]); // yyyy, mm (0-based), dd
        }

        var dateDebut = parseDate(dateDebutStr);
        var dateFin = parseDate(dateFinStr);
        var filterStart = startDate ? new Date(startDate) : null;
        var filterEnd = endDate ? new Date(endDate) : null;

        if (filterStart && dateDebut < filterStart) {
            return false;
        }

        if (filterEnd && dateFin > filterEnd) {
            return false;
        }

        return true;
    });

    // Appliquer filtre au clic
    $('#filter-dates').click(function() {
        table.draw();
    });
});


$(document).ready(function () {
    $('#toggle-date-filter').on('click', function () {
        $('#date-filter').toggleClass('d-none');
    });
});