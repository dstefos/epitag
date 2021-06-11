<?php

namespace App\Http\Livewire\Bundle;

use App\Models\bundle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $bundles, $newTitle, $newPrice, $newQuantity, $newImage, $showDialog=false;

    protected $rules = [
        'newTitle' => 'required',
        'newQuantity' => 'required',
        'newPrice' => 'required',
        'newImage' => 'image',
    ];

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
            dd('not authorized');
        
        bundle::destroy($bundle->id);
        $this->bundles=bundle::get();
        session()->flash('message', 'Bundle deleted.');
    }

    public function updated()
    {
        $this->showDialog=true;

    }

    public function submit()
    {
        if(!Auth::user()->admin)
            dd('not authorized');
        $this->showDialog=true;
        $this->validate();
        // $this->showDialog=false;
        $this->newImage->store('img', ['disk' => 'public']);
        // bundle::create(
        //     [
        //         'title'=>$this->newTitle,
        //         'price'=>$this->newPrice,
        //         'quantity'=>$this->newQuantity,
        //         'image'=>$this->newImage
        //     ]
        // );
    }
}