<?php

namespace App\Http\Livewire\Bundle;

use App\Models\bundle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $bundles;

    public function mount()
    {
        $this->bundles=bundle::get();
    }

    public function render()
    {
        return view('livewire.bundle.index');
    }

    public function buy(bundle $bundle)
    {
        // dd('asdf');
        $bundle->boughtBy(Auth::user());
    }

    public function delete(bundle $bundle)
    {
        if(!Auth::user()->admin)
            return 'not authorized';
        
        bundle::destroy($bundle->id);
        $this->bundles=bundle::get();
    }
}
