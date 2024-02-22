<?php

namespace app\models;

use juanignaso\phpmvc\framework\Model;
use juanignaso\phpmvc\framework\Application;


class EditUserForm extends Model
{
    public string $nombre;
    public string $email;
    public string $password;
    public string $id;

    public function rules(): array
    {
        return
            [
                'nombre' => [[self::RULE_UNIQUE, 'class' => self::class]],
                'email' => [self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
                'password' => [],
                'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']]
            ];
    }

    public function loadData($data)
    {
        /*
        con esto estamos cogiendo los datos y asignandolos a las
        propiedades del modelo

        */
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        // if (isset($this->password)) {
        //     echo 'pass is not set';
        // }
    }

    public function attributes(): array
    {
        return ['nombre', 'email', 'password'];
    }

    public function edit($id): bool
    {
        $this->id = $id;
        $table = $this->tableName();
        $attributes = $this->attributes();
        for ($i = 0; $i < count($attributes); $i++) {
            if (!isset($this->{$attributes[$i]})) {
                unset($attributes[$i]);
                echo $attributes[$i] . ' is not set';
            }
        }
        var_dump($attributes);
        exit;
        if (isset($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        $sql = implode(',', array_map(fn($attr) => "$attr=:$attr", $attributes));
        $statement = self::prepare("UPDATE " . $table . " SET " . $sql . " WHERE id=:id");

        foreach ($attributes as $attr) {
            $statement->bindValue(":$attr", $this->{$attr});
        }
        $statement->bindValue(":id", $this->id);
        $statement->execute();
        return $statement->rowCount() != 0;
    }


    public function tableName(): string
    {
        return 'usuarios';
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