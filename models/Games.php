<?php

namespace app\models;

use juanignaso\phpmvc\framework\Application;


class Games
{

    private const TABLE_NAME = 'games';//tabla de la bbdd
    public string $id = '';

    public string $usuario;

    public string $difficulty = '1';

    public int $score;

    public string $finished_at = '';

    public int $game_finished = 1;

    public function __construct()
    {
        $this->usuario = !Application::isGuest() ? Application::$app->user->id : '';
    }

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function saveGame()
    {
        $statement = self::prepare("INSERT INTO " . self::TABLE_NAME . " (user_id,dif_id,score,game_finished) VALUES(:usr_id,:dif_id,:score,:finished)");
        $statement->bindValue(":usr_id", $this->usuario);
        $statement->bindValue(":dif_id", $this->difficulty);
        $statement->bindValue(":score", $this->score);
        $statement->bindValue(":finished", $this->game_finished);
        return $statement->execute();
    }

    public function getPersonalScores()
    {
        $statement = self::prepare("SELECT " . self::TABLE_NAME . ".*,usuarios.nombre FROM " . self::TABLE_NAME . " LEFT JOIN usuarios ON " . self::TABLE_NAME . ".user_id = usuarios.id WHERE user_id=:user ORDER BY score DESC LIMIT 10");
        $statement->bindValue(":user", $this->usuario);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getHighScore()
    {
        return self::query("SELECT " . self::TABLE_NAME . ".*,usuarios.nombre FROM " . self::TABLE_NAME . " LEFT JOIN usuarios ON " . self::TABLE_NAME . ".user_id = usuarios.id ORDER BY score DESC LIMIT 10")->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function query($sql)
    {
        return Application::$app->db->pdo->query($sql);
    }
}