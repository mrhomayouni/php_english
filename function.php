<?php
require "db.php";

function get_question_by_rand(): ?int
{
    global $pdo;

    $sql = "SELECT `id` FROM `questions` ORDER BY RAND() LIMIT 1;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result === false) return null;
    return $result;
}

function get_words_by_rand($question_id): array
{
    global $pdo;

    $sql = "SELECT * FROM `words` WHERE `question_id` = :question_id ORDER BY RAND();";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("question_id", $question_id);
    $stmt->execute();
    $question = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $question;
}

function get_word_by_id($id): array
{
    global $pdo;

    $sql = "SELECT * FROM `words` WHERE `id` = :id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("id", $id);
    $stmt->execute();
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    return $question;
}

function order_word($question_id): array
{
    global $pdo;

    $sql = "SELECT * FROM `words` WHERE `question_id` = :question_id ORDER BY `order`;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("question_id", $question_id);
    $stmt->execute();
    $question = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $question;
}