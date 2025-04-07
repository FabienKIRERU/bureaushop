<?php

namespace App\Services;

use App\Repositories\OrderItemRepository;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderItemService {
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository) {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllOrderItems() {
        return $this->orderItemRepository->getAll();
    }

    public function getOrderItemDetails(int $id) {
        return $this->orderItemRepository->findById($id);
    }

    public function getItemsByOrderId(int $orderId) {
        return $this->orderItemRepository->getByOrderId($orderId);
    }

    public function createOrderItem(array $data) {
        DB::beginTransaction();
        try {
            $orderItem = $this->orderItemRepository->create($data);
            DB::commit();
            return $orderItem;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur lors de l'ajout de l'article à la commande : " . $e->getMessage());
        }
    }

    public function updateOrderItem(OrderItem $orderItem, array $data) {
        return $this->orderItemRepository->update($orderItem, $data);
    }

    public function deleteOrderItem(OrderItem $orderItem) {
        return $this->orderItemRepository->delete($orderItem);
    }
}
