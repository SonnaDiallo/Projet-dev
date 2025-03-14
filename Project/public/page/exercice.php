<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription - Skill MATCH</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            line-height: 1.6;
        }

        .navbar {
            background-color: #ff6600;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo-container {
            display: flex;
            align-items: center;
        }

        .navbar .logo {
            height: 40px; /* Taille du logo */
            margin-right: 1rem; /* Espacement à droite du logo */
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1rem;
        }

        .navbar nav ul li {
            display: inline;
            position: relative;
        }

        .navbar nav ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 0;
            position: relative;
        }

        .navbar nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            margin-top: 5px;
            right: 0;
            background: white;
            transition: width 0.2s ease, background-color 0.2s ease;
        }

        .navbar nav ul li a:hover::after {
            width: 100%;
            left: 0;
            background: white;
        }

        form {
            max-width: 400px;
            margin: 2rem auto;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 1em;
        }

        form label {
            margin-bottom: .5em;
            color: #333;
            display: block;
            font-weight: bold;
        }

        form input, form select {
            border: 1px solid #ccc;
            padding: .5em;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
            border-radius: 5px;
        }

        form button {
            padding: 0.7em;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1.2em;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .message {
            max-width: 400px;
            margin: 1em auto;
            padding: 1em;
            background: #e9ffe9;
            border-radius: 5px;
            color: green;
        }

        .message.error {
            background: #ffe9e9;
            color: red;
        }
        .logo {
    height: 40px; /* Taille du logo */
    margin: 10px; /* Espacement à droite du logo */
    padding: auto;
    height: 120px;
}
.logos {
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}
    </style>
</head>
<body>

<header class="navbar">
    <div class="logos">
        <img src="Image du projet fin d'annee/Freelance_jungle.png" alt="SkillMatch " class="logo">
        <h1>SkillMatch</h1>
    </div>
    
    <nav>
        <ul>
            <li><a href="exercice.php">Mon espace</a></li>
            <li><a href="traitement_formulaire.php" onmouseover="changeText()">Proposer un service</a></li>
            <li><a href="page 2.html">Chercher un service</a></li>
        </ul>
    </nav>
</header>

<main>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Mettez votre mot de passe MySQL ici
    $dbname = "formulaire_db";

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
        $status = htmlspecialchars($_POST['status']);

        if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($password) && !empty($status)) {
            $stmt = $conn->prepare("INSERT INTO utilisateurs (prenom, nom, email, password, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $prenom, $nom, $email, $password, $status);

            if ($stmt->execute()) {
                if ($status == "Acheteur") {
                    header("Project\public\page\page 2.html");
                } else {
                    header("traitement_formulaire.php");
                }
                exit();
            } else {
                $message = "<div class='message error'><p>Erreur lors de l'enregistrement des données.</p></div>";
            }

            $stmt->close();
        } else {
            $message = "<div class='message error'>
                            <p>Veuillez remplir tous les champs du formulaire.</p>
                        </div>";
        }
    }

    $conn->close();
    ?>

    <form action="exercice.php" method="post">
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="status">Status :</label>
            <select id="status" name="status" required>
                <option value="Acheteur">Acheteur</option>
                <option value="Freelance">Freelance</option>
            </select>
        </div>
        <div>
            <button type="submit">S'inscrire</button>
        </div>
    </form>

    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>
</main>

</body>
</html>
