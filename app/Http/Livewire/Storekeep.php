<?php

namespace App\Http\Livewire;

use App\Models\category;
use App\Models\stock;
use Livewire\Component;

class Storekeep extends Component
{
    public $store ='';
    public $categories  ='';

    public $count = 0;

    public function mount()
    {
        // $this->store = '';
        $this->store = stock::all();
        $this->categories = category::all();
        $this->count;
    }

    public function IncrementQty($id)
    {
        $this->count++;
        $carts = stock::find($id);
        $carts->increment('stock_alert', 1);
        // $carts->increment('item_taken', 1);
        $this->mount();
    }

    public function DecrementQty($id)
    {
        $this->count--;
        $carts = stock::find($id);
        $carts->decrement('stock_alert', 1);
        // $carts->decrement('item_taken', 1);

        $this->mount();
    }


    public function render()
    {
        return view('livewire.storekeep');
    }
}
