<?php
        try{
            $stmt = $db->prepare("UPDATE interests SET name = ? WHERE id = ?");
            $stmt->execute([$name, $id]);

            $_SESSION['message'] = "Zájem byl upraven.";

        }catch(PDOException $e){
            $_SESSION['message'] = "Tento zájem už existuje.";
        }
    }

    header("Location: index.php");
    exit;
}

// Načtení dat
$stmt = $db->query("SELECT * FROM interests ORDER BY id DESC");
$interests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>IT Profil</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Moje zájmy</h1>

<?php if($message): ?>
<div class="message"><?= $message ?></div>
<?php endif; ?>

<h2>Přidat zájem</h2>
<form method="POST">
<input type="text" name="name" placeholder="Nový zájem">
<button name="add">Přidat</button>
</form>

<h2>Seznam</h2>

<ul>
<?php foreach($interests as $i): ?>

<li>

<form method="POST" class="edit-form">

<input type="hidden" name="id" value="<?= $i['id'] ?>">

<input type="text" name="name" value="<?= htmlspecialchars($i['name']) ?>">

<button name="edit">Upravit</button>

<a class="delete" href="?delete=<?= $i['id'] ?>">Smazat</a>

</form>

</li>

<?php endforeach; ?>
</ul>

</body>
</html>
