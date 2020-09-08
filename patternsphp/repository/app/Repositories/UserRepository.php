<?php

namespace App\Repositories;

use Sales\Database\DbProvider;
use App\Models\User;
use PDO;

class UserRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = DbProvider::get();
    }

    public function find(int $id): ?User
    {
        $result = null;

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from users where id = :id');
        // 02. Execute query
        $stm->execute(['id' => $id]);
        // 03. Fetch Single
        $data = $stm->fetchObject('\\App\\Models\\User');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function findAll(): array
    {
        $result = [];

        // 01. Prepare query
        $stm = $this->_db->prepare('select * from users');
        // 02. Execute query
        $stm->execute();
        // 03. Fetch All
        $data = $stm->fetchAll(PDO::FETCH_CLASS, '\\App\\Models\\User');
        // 04. Verify if result is null
        if ($data) {
            $result = $data;
        }

        return $result;
    }

    public function add(User $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'insert into users(first_name, last_name, user_name, password, created_at, updated_at) values (:first_name, :last_name, :user_name, :password, :created, :updated)'
        );

        $now = date('Y-m-d H:i:s');
        // 02. Execute query
        $stm->execute([
            'first_name' => $model->first_name,
            'last_name' => $model->last_name,
            'user_name' => $model->user_name,
            'password' => $model->password,
            'created' => $now,
            'updated' => $now,
        ]);
    }

    public function update(User $model): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare('
                update users
                set 
                    first_name = :first_name,
                    last_name = :last_name,
                    user_name = :user_name,
                    password = : password,
                    updated_at = :updated
                where id = :id
            ');
        // 02. Execute query
        $stm->execute([
            'name' => $model->name,
            'price' => $model->price,
            'updated' => date('Y-m-d H:i:s'),
            'id' => $model->id,
        ]);
    }

    public function remove(int $id): void
    {
        // 01. Prepare query
        $stm = $this->_db->prepare(
            'delete from users where id = :id'
        );
        // 02. Execute query
        $stm->execute(['id' => $id]);
    }
}
