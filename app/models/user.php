<?php

class User extends BaseModel {

// Attribuutit
    public $id, $name, $password;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Client');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();

        foreach ($rows as $row) {
            $users[] = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
            ));
        }
        return $users;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Client WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
            ));

            return $user;
        }
    }

    public function authenticate($name, $password) {
 
        $query = DB::connection()->prepare('SELECT * FROM Client WHERE name = :name AND password = :password');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        Kint::dump($row);
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
            ));
            return $user;
        } else {
            return null;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Client (name, password) VALUES (:name, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
