<?php

declare(strict_types=1);

namespace App\Models;

class Order
{
    public $id;

    // User client
    public $user_id;
    public $client;

    public $total = 0;

    // User creater
    public $creater_id;
    public $creater;

    public $created_at;
    public $updated_at;

    // Order Detail
    public $detail = [];
}
