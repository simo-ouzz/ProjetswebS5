<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Nouveau Projet</title>
    <style>
        /* styles internes */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 1rem;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #4CAF50;
            outline: none;
        }

        textarea {
            height: 150px;
        }

        select {
            font-size: 1rem;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un Nouveau Projet</h2>
        <form action="projectAction.php?action=add" method="POST">
            <div class="form-group">
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="summary">Résumé :</label>
                <textarea id="summary" name="summary" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="status">État :</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="En cours">En cours</option>
                    <option value="Terminé">Terminé</option>
                    <option value="À venir">À venir</option>
                </select>
            </div>

            <div class="form-group">
                <label for="admin">Nom de l'Administrateur :</label>
                <input type="text" id="admin" name="admin" class="form-control" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Ajouter le Projet">
        </form>
    </div>
</body>
</html>
