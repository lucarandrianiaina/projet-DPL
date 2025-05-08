<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "dpl"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer le nombre d'activités par responsable
$sql = "
    SELECT p.nom_p, COUNT(a.id_a) AS activities_count
    FROM activite a
    JOIN personnel p ON a.id_resp = p.id_p
    GROUP BY p.nom_p
    ORDER BY activities_count DESC
";
$result = $conn->query($sql);

$names = [];
$counts = [];
$totalActivities = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $names[] = $row['nom_p']; // Nom du responsable
        $counts[] = $row['activities_count']; // Nombre d'activités
        $totalActivities += $row['activities_count']; // Total des activités
    }
}

$conn->close();

// Calcul des pourcentages
$percentages = array_map(function($count) use ($totalActivities) {
    return ($totalActivities > 0) ? round(($count / $totalActivities) * 100, 2) : 0;
}, $counts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique des activités par responsable (Doughnut)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Réduction de la taille du graphique */
        #activityByResponsibleDoughnutChart {
            width: 80%; /* Taille plus petite */
            max-width: 500px; /* Taille maximale */
            margin: auto;
        }
    </style>
</head>
<body>
    <div>
        <h2>Nombre d'activités par responsable</h2>
        <canvas id="activityByResponsibleDoughnutChart" width="400" height="400"></canvas>
    </div>

    <script>
        // Les données provenant de PHP
        var names = <?php echo json_encode($names); ?>;
        var activityCounts = <?php echo json_encode($counts); ?>;
        var percentages = <?php echo json_encode($percentages); ?>;

        // Configuration du graphique Doughnut (fromage)
        var ctx = document.getElementById('activityByResponsibleDoughnutChart').getContext('2d');
        var activityByResponsibleDoughnutChart = new Chart(ctx, {
            type: 'doughnut', // Type de graphique : 'doughnut' pour un graphique en anneau
            data: {
                labels: names, // Noms des responsables extraits de la base de données
                datasets: [{
                    label: 'Nombre d\'activités',
                    data: activityCounts, // Le nombre d'activités pour chaque responsable
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)'
                    ], // Couleurs de chaque segment du doughnut
                    borderColor: '#fff', // Couleur de la bordure
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top', // Position de la légende
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                // Afficher le nombre d'activités et le pourcentage
                                var label = tooltipItem.label + ': ' + tooltipItem.raw + ' activités';
                                var percentage = percentages[tooltipItem.dataIndex];
                                return label + ' (' + percentage + '%)';
                            }
                        }
                    },
                    // Ajouter les labels à l'intérieur du doughnut
                    datalabels: {
                        formatter: function(value, context) {
                            var percentage = percentages[context.dataIndex];
                            return value + ' (' + percentage + '%)'; // Affiche le nombre et le pourcentage
                        },
                        color: '#fff', // Couleur du texte
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        align: 'center',
                        anchor: 'center'
                    }
                }
            }
        });
    </script>
</body>
</html>
