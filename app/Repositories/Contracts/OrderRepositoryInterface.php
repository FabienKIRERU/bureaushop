<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface{

    public function getAll();

    public function findById(int $id);

    public function updateStatus($id, $status);

    public function create(array $data);

    public function update(Order $order, array $data);

    public function delete(Order $order);
}