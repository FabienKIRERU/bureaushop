<?php

namespace App\Repositories\Contracts;

use App\Models\OrderItem;

interface OrderItemRepositoryInterface{


    public function getAll();

    public function findById(int $id);

    public function getByOrderId(int $orderId);

    public function create(array $data);

    public function update(OrderItem $orderItem, array $data);

    public function delete(OrderItem $orderItem);
}