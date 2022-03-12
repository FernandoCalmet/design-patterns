<?php

namespace App\Cache;

use App\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepositories;
use Illuminate\Database\Eloquent\Model;

class UserCache extends BaseCache implements UserRepositoryInterface
{
    public function __construct(UserRepositories $userRepositories)
    {
        parent::__construct($userRepositories, 'user');
    }

    public function all()
    {
        return $this->cache::remember($this->key, self::TTL, function () {
            return $this->repository->all();
        });
    }

    public function get(int $id)
    {
        return $this->repository->get($id);
    }

    public function save(Model $model)
    {
        $this->forget($this->key);

        return $this->repository->save($model);
    }

    public function delete(Model $model)
    {
        $this->forget($this->key);

        return $this->repository->delete($model);
    }

    public function getWithSameFirstAndLastName(string $name)
    {
        return $this->cache::remember("$this->key.same_name", self::TTL, function () use ($name) {
            return $this->repository->getWithSameFirstAndLastName($name);
        });
    }
}
