<?php
require "function.php";

$question_id = count(question());

$flag0 = false;
if ($question_id > 0) {
    $flag0 = true;
    $rand = rand(1, $question_id);
    $words = word($rand);
    $flag2 = true;
    if (isset($_POST["send"]) and is_array($_POST["answer"])) {
        $flag2 = false;
        $answers = $_POST["answer"];
        $flag = 0;
        if (isset($answers)) {
            foreach ($answers as $i => $answer_item) {
                $a = get_word_by_id($i);
                if (!($answer_item == $a["order"])) {
                    $flag++;
                }
            }
            if ($flag > 0) {
                $order_words = order_word($_POST["x"]);
                echo "Your answer is wrong" . "<br>";
                foreach ($order_words as $item) {
                    echo $item["word"] . " ";
                }

            } else {
                echo "Your answer is correct";
            }
        }
    }
} else {
    echo "بانک سوال خالی است و لطفا ابتدا سوالات را در بانک درج کنید و سپس تلاش کنید.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>English questions</title>
</head>
<body>
<?php if ($flag0 == true) { ?>
    <?php if ($flag2 == true) { ?>
        <form action="" method="post">
            <?php foreach ($words as $item) { ?>
                <label for=""><?= $item["text"] ?> </label>
                <input type="number" name="answer[<?= $item["id"] ?>]"> <br> <br>
            <?php } ?>
            <input type="hidden" name="x" value="<?= $rand ?>">
            <input type="submit" value="send" name="send">
        </form>
    <?php }
} ?>
</body>
</html>