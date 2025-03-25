<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Tâche</title>
    <link rel="stylesheet" href="styles.css">
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

        h1 {
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
        <h1>Modifier la Tâche</h1>

        <form action="/tacheAction.php?action=edit&id=<?= $task['id'] ?>" method="POST">
            <div class="form-group">
                <label>Description :</label>
                <input class="form-control" type="text" name="description" value="<?= htmlspecialchars($task['description']) ?>" required>
            </div>

            <div class="form-group">
                <label>Status :</label>
                <select class="form-control" name="status">
                    <option value="Not Started" <?= $task['status'] === 'Not Started' ? 'selected' : '' ?>>Not Started</option>
                    <option value="In Progress" <?= $task['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="Done" <?= $task['status'] === 'Done' ? 'selected' : '' ?>>Done</option>
                </select>
            </div>

            <button type="submit" class="btn">Modifier la Tâche</button>
        </form>
    </div>
</body>
</html>
