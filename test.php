<?php
// PDO Connection
try {
    $db = new PDO('mysql:host=localhost;dbname=php_english', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error: " . $e->getMessage() . "\n";
    exit();
}

function getRandomQuestion(): ?int
{
    global $db;

    $sql = "SELECT `id` FROM `questions` ORDER BY RAND() LIMIT 1;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result === false) return null;
    return $result;
}

function getRandomWordsOfQuestion(int $question_id): array
{
    global $db;

    $sql = "SELECT `id`, `text`, `order` FROM `words` WHERE `question_id` = :question_id ORDER BY RAND();";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getWordsOfAQuestion(int $question_id): array
{
    global $db;

    $sql = "SELECT `id`, `text`, `order` FROM `words` WHERE `question_id` = :question_id ORDER BY `order` ASC;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getRealOrderOfAWord(int $word_id): ?int
{
    global $db;

    $sql = "SELECT `order` FROM `words` WHERE `id` = :word_id;";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':word_id', $word_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    if ($result === false) return null;
    return $result;
}