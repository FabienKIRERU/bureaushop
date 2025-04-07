<?php

namespace App\Services;

use Exception;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;

class OrderService {
    protected $orderRepository;
    protected $orderItemRepository;

    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function getAllOrders() {
        return $this->orderRepository->getAll();
    }

    public function updateOrderStatus($id, $status){
        return $this->orderRepository->updateStatus($id, $status);
    }

    public function getOrderDetails(int $id) {
        return $this->orderRepository->findById($id);
    }

    public function createOrder(array $data) {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->create($data);
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur de commende : " . $e->getMessage());
        }
    }

    public function createOrderWithItems(array $orderData, array $itemsData) {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->create($orderData);
    
            foreach ($itemsData as $item) {
                $item['order_id'] = $order->id;
                $this->orderItemRepository->create($item);
            }
            DB::commit();
            return $order;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Erreur de commende : " . $e->getMessage());
        }
    }
}
