<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

class ItemService {
    public function all(): Collection {
        return Item::with('category')->get();
    }
    public function find(int $id): Item {
        return Item::with('category')->findOrFail($id);
    }

    public function create(array $data)
{
    $item = Item::create($data);

    Log::info('Item created', [
        'id' => $item->id,
        'data' => $data
    ]);

    return $item;
    }

   public function update($id, array $data)
    {
    $item = Item::findOrFail($id);

    $item->update($data);

    Log::info('Item updated', [
        'id' => $id,
        'changes' => $data
    ]);

    return $item;
    }
    
    public function delete($id)
    {
    $item = Item::findOrFail($id);

    $item->delete();

    Log::info('Item deleted', [
        'id' => $id
    ]);
    }

}