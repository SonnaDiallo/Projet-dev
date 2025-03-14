<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form div {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            resize: vertical;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        #other_expertise_container {
            display: none;
        }
    }
        #other_ville_container {
            display: none;
        }
    </style>
    <script>
        function toggleOtherExpertise() {
            var expertiseSelect = document.getElementById("expertise");
            var otherExpertiseContainer = document.getElementById("other_expertise_container");
            if (expertiseSelect.value === "Autre") {
                otherExpertiseContainer.style.display = "block";
            } else {
                otherExpertiseContainer.style.display = "none";
            }
        }
        function toggleOtherVille() {
            var villeSelect = document.getElementById("ville");
            var otherVilleContainer = document.getElementById("other_ville_container");
            if (villeSelect.value === "Autre ville") {
                otherVilleContainer.style.display = "block";
            } else {
                otherVilleContainer.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Service</h1>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root"; // Changez ceci si nécessaire
            $password = ""; // Changez ceci si nécessaire
            $dbname = "formulaire_db";

            // Créer une connexion
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué: " . $conn->connect_error);
            }

            // Récupérer les données du formulaire
            $nom = $conn->real_escape_string($_POST['nom']);
            $prenom = $conn->real_escape_string($_POST['prenom']);
            $expertise = $conn->real_escape_string($_POST['expertise']);
            if ($expertise == "Autre") {
                $expertise = $conn->real_escape_string($_POST['other_expertise']);
            }
            $prix = $conn->real_escape_string($_POST['prix']);
            $service_propose = $conn->real_escape_string($_POST['service_propose']);
            $ville = $conn->real_escape_string($_POST['ville']);
            if ($ville == "Autre ville") {
                $ville = $conn->real_escape_string($_POST['other_ville']);
            }

            // Préparer et exécuter la requête SQL
            $sql = "INSERT INTO service (nom, prenom, expertise, prix, service_propose, ville)
                    VALUES ('$nom', '$prenom', '$expertise', '$prix', '$service_propose', '$ville')";

            if ($conn->query($sql) === TRUE) {
                echo '<div class="message">Service ajouté avec succès.</div>';
            } else {
                echo "Erreur: " . $sql . "<br>" . $conn->error;
            }

            // Fermer la connexion
            $conn->close();
        }
        ?>

        <form action="" method="post">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div>
                <label for="expertise">Expertise :</label>
                <select id="expertise" name="expertise" onchange="toggleOtherExpertise()" required>
                    <option value="Photographie et Vidéographie">Photographie et Vidéographie</option>
                    <option value="Consulting en Gestion de Projet">Consulting en Gestion de Projet</option>
                    <option value="Formation et Coaching">Formation et Coaching</option>
                    <option value="Support Technique et Informatique">Support Technique et Informatique</option>
                    <option value="Ressources Humaines et Recrutement">Ressources Humaines et Recrutement</option>
                    <option value="Développement Web">Développement Web</option>
                    <option value="Design Graphique">Design Graphique</option>
                    <option value="Rédaction et Traduction">Rédaction et Traduction</option>
                    <option value="Développement de Logiciels">Développement de Logiciels</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            <div id="other_expertise_container">
                <label for="other_expertise">Autre expertise :</label>
                <input type="text" id="other_expertise" name="other_expertise">
            </div>
            <div>
                <label for="prix">Prix :</label>
                <input type="number" id="prix" name="prix" min="100" max="1000" step="50" required>
            </div>
            <div>
                <label for="service_propose">Service proposé :</label>
                <textarea id="service_propose" name="service_propose" required></textarea>
            </div>
            <div>
                <label for="ville">Ville :</label>
                <select id="ville" name="ville"  onchange="toggleOtherVille()" required>
                    <option value="">Localisation</option>
                    <option value="Paris">Paris</option>
                    <option value="Montreuil">Montreuil</option>
                    <option value="Noisy-le-Grand">Noisy-le-Grand</option>
                    <option value="Argenteuil">Argenteuil</option>
                    <option value="Vitry-sur-Seine">Vitry-sur-Seine</option>
                    <option value="Ile de France">Ile de France</option>
                    <option value="Autre ville">Autre ville</option>
                </select>
            </div>
            <div id="other_ville_container">
                <label for="other_ville">Autre ville:</label>
                <input type="text" id="other_ville" name="other_ville">
            </div>
            <div>
                <button type="submit">Ajouter</button>
            </div> <div id="other_ville_container">
             
        </form>
    </div>
</body>
</html>
