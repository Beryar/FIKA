<?php
session_start();

// Initialize session arrays if they are not set
if (!isset($_SESSION['names'])) {
    $_SESSION['names'] = [];
}
if (!isset($_SESSION['countries'])) {
    $_SESSION['countries'] = [];
}
if (!isset($_SESSION['ingredients'])) {
    $_SESSION['ingredients'] = [];
}

// Capture the input from any of the forms
if (isset($_GET['input'])) {
    if (!empty($_GET['name'])) {
        $_SESSION['names'][] = htmlspecialchars($_GET['name']);
    } elseif (!empty($_GET['country'])) {
        $_SESSION['countries'][] = htmlspecialchars($_GET['country']);
    } elseif (!empty($_GET['ingredient'])) {
        $_SESSION['ingredients'][] = htmlspecialchars($_GET['ingredient']);
    }
}

// Handle the 'Clear All' button to reset session data
if (isset($_GET['clear'])) {
    session_destroy();
    header("Location: names.php");  // Reload page to clear session
    exit();
}

// Handle the 'Randomize' button
if (isset($_GET['randomize'])) {
    $names = $_SESSION['names'];
    $countries = $_SESSION['countries'];
    $ingredients = $_SESSION['ingredients'];

    $randomNames = [];
    if (count($names) >= 3) {
        $randomNames = array_rand(array_flip($names), 3);
    } else {
        $randomNames = $names;
    }

    $randomCountry = $countries[array_rand($countries)];
    $randomIngredient = $ingredients[array_rand($ingredients)];

    $_SESSION['random'] = [
        'names' => $randomNames,
        'country' => $randomCountry,
        'ingredient' => $randomIngredient,
    ];

    header("Location: names.php");  // Reload page to show random result
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIKA</title>
    <link rel="stylesheet" href="style.css">
    <script src="animation.js" defer></script>
</head>
<body>
<main>
    <audio id="backgroundAudio" loop>
        <source src="audio/audio.mp3" type="audio/mp3">
    </audio>
    <section id="sec1">
        <!-- Name Input -->
        <form id="nameInput" action="names.php" method="GET">
            <label class="name" for="name">Name:</label>
            <input type="text" id="nameFild" name="name">
            <button class="button" name="input" type="submit">INPUT</button>
            <button class="button" id="next" name="next_name" type="submit">Next</button>
        </form>

        <!-- Country Input -->
        <form id="countryInput" action="names.php" method="GET">
            <label class="name" for="country">Country:</label>
            <input type="text" id="nameFild" name="country">
            <button class="button" name="input" type="submit">INPUT</button>
            <button class="button" id="next" name="next_country" type="submit">Next</button>
        </form>

        <!-- Ingredient Input -->
        <form id="ingredientInput" action="names.php" method="GET">
            <label class="name" for="ingredient">Ingredient:</label>
            <input type="text" id="nameFild" name="ingredient">
            <button class="button" name="input" type="submit">INPUT</button>
            <button class="button" id="next" name="next_ingredient" type="submit">Next</button>
        </form>

        <!-- Display Lists -->
        <section id="namesList">
            <h2>Names List:</h2>
            <ul>
                <?php
                if (!empty($_SESSION['names'])) {
                    foreach ($_SESSION['names'] as $name) {
                        echo "<li>" . htmlspecialchars($name) . "</li>";
                    }
                }
                ?>
            </ul>
        </section>

        <section id="countriesList">
            <h2>Countries List:</h2>
            <ul>
                <?php
                if (!empty($_SESSION['countries'])) {
                    foreach ($_SESSION['countries'] as $country) {
                        echo "<li>" . htmlspecialchars($country) . "</li>";
                    }
                }
                ?>
            </ul>
        </section>

        <section id="ingredientsList">
            <h2>Ingredients List:</h2>
            <ul>
                <?php
                if (!empty($_SESSION['ingredients'])) {
                    foreach ($_SESSION['ingredients'] as $ingredient) {
                        echo "<li>" . htmlspecialchars($ingredient) . "</li>";
                    }
                }
                ?>
            </ul>
        </section>

        <!-- Randomize Button -->
        <form action="names.php" method="GET">
            <button type="submit" name="randomize" class="button">Randomize</button>
        </form>

        <!-- Randomization Result -->
        <?php if (isset($_SESSION['random'])): ?>
            <section id="randomResult">
                <h2>Random Selection:</h2>
                <p><strong>Names:</strong></p>
                <ul>
                    <?php
                    if (is_array($_SESSION['random']['names'])) {
                        foreach ($_SESSION['random']['names'] as $name) {
                            echo "<li>" . htmlspecialchars($name) . "</li>";
                        }
                    } else {
                        echo "<li>No sufficient names to randomize.</li>";
                    }
                    ?>
                </ul>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($_SESSION['random']['country']); ?></p>
                <p><strong>Ingredient:</strong> <?php echo htmlspecialchars($_SESSION['random']['ingredient']); ?></p>
            </section>
        <?php endif; ?>

        <!-- Clear All Button -->
        <form action="names.php" method="GET">
            <button type="submit" name="clear" class="button">Clear All</button>
        </form>
    </section>
</main>
<footer>
    <button id="playAudioButton">Play Audio</button>
    <button id="muteAudioButton">Mute Music</button>
</footer>
</body>
</html>
