<?php
require "db.php";

function question()
{
    global $pdo;
    $sql = "SELECT * FROM `question`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $question = $stmt->fetchAll();
    return $question;
}

function word($question_id)
{
    global $pdo;
    $sql = "SELECT * FROM `word` WHERE `question_id`=:question_id ORDER BY rand()";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("question_id", $question_id);
    $stmt->execute();
    $question = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $question;
}

function get_word_by_id($id)
{
    global $pdo;
    $sql = "SELECT * FROM `word` WHERE `id`=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("id", $id);
    $stmt->execute();
    $question = $stmt->fetch(PDO::FETCH_ASSOC);
    return $question;

}

function order_word($question_id)
{
    global $pdo;
    $sql = "SELECT * FROM `word` WHERE `question_id`=:question_id ORDER BY `order`";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue("question_id", $question_id);
    $stmt->execute();
    $question = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $question;
}