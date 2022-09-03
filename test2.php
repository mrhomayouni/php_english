<?php
require "test.php";

if (isset($_POST["check"], $_POST["question_id"], $_POST["order"]) && is_array($_POST["order"])) {
    $question_id = (int)$_POST["question_id"];
    $orders = $_POST["order"];
    $status = true;
    foreach ($orders as $word_id => $order) {
        $real_order = getRealOrderOfAWord($word_id);
        if ($real_order === null) {
            $status = false;
            break;
        }

        $order = (int)$order;
        // print $order . " - " . $real_order . "\n";
        if ($order !== $real_order) {
            $status = false;
            break;
        }
    }

    if ($status === true) {
        echo "Correct!";
    } else {
        echo "Wrong!";
        echo "<br>";

        $correct_ordered_words = getWordsOfAQuestion($question_id);
        $correct_ordered_words = array_column($correct_ordered_words, "text", "id");
        print implode(", ", $correct_ordered_words);
    }
    echo '<br><a href="">Try another question!</a>';
    exit();
}

$question_id = getRandomQuestion();
if ($question_id === null) {
    echo "No questions found.";
    exit();
}

$words = getRandomWordsOfQuestion($question_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English</title>
</head>
<body>
<center>
    <h1>English #<?= $question_id ?></h1>
</center>
<hr>
<form action="" method="POST">
    <input type="hidden" name="question_id" value="<?= $question_id ?>">
    <center>
        <?php foreach ($words as $word_item) { ?>
            <label><?= $word_item["text"] ?></label>
            <input type="number" name="order[<?= $word_item["id"] ?>]" min="1" required="">
            <br>
        <?php } ?>
        <br>
        <button name="check">Check</button>
    </center>
</form>
</body>
</html>