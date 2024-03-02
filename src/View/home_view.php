<?php
include __DIR__ . "/../../bootstrap.php";
use Doctrine\ORM\EntityManagerInterface;
use Model\User;

$currUser = $entityManager->getRepository(User::class)->find($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/View/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="/">My-Admin</a></p>
        </div>

        <div class="right-links">
            <?php if(isset($_SESSION['id'])): ?>
                <a href="/edit">Change Profile</a>
                <a href="/logout"><button class="btn">Logout</button></a>
            <?php endif; ?>
        </div>
    </div>

    <main>
            <div class="main-box top">
                <div class="top">
                    <div class="box">
                    <?php
                    if(isset($_SESSION['id'])) {
                        $name = $currUser->getName();
                        echo "<p>Hello <b>$name</b>, Welcome!</p>";
                    }
                    ?>
                    </div>

                    <div class="box">
                    <?php
                    if(isset($_SESSION['id'])) {
                        $email = $currUser->getEmail();
                        echo "<p>Your registered email is  <b>$email</b></p>";
                    }
                    ?>
                    </div>
                </div>
                <div class="bottom">
                    <div class="box">
                    <?php
                    if(isset($_SESSION['id'])) {
                        $age = $currUser->getAge();
                        echo "<p>And you are <b>$age</b> years old.</p>";
                    }
                    ?>
                    </div>
                </div>
            </div>
    </main>
</body>
</html>
