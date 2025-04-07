<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface {

    protected $orderItem;

    public function __construct(?OrderItem $orderItem = null)
    {
       $this->orderItem = $orderItem ?? new OrderItem();
    }
    
    public function getAll(): Collection {
        return OrderItem::with(['order', 'property'])->get();
    }

    public function findById(int $id): ?OrderItem {
        return OrderItem::with(['order', 'property'])->findOrFail($id);
    }

    public function getByOrderId(int $orderId): Collection {
        return OrderItem::where('order_id', $orderId)->with('property')->get();
    }

    public function create(array $data): OrderItem {
        return OrderItem::create($data);
    }

    public function update(OrderItem $orderItem, array $data): OrderItem {
        $orderItem->update($data);
        return $orderItem;
    }

    public function delete(OrderItem $orderItem): bool {
        return $orderItem->delete();
    }
}
