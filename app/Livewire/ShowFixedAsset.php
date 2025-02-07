<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FixedAsset;

class ShowFixedAsset extends Component
{
    public $selectedAsset; // Store selected asset details

    protected $listeners = ['showAssetDetails']; // Listening for row click

    public function showAssetDetails($id)
    {
        $this->selectedAsset = FixedAsset::find($id);
    }
    
    public function render()
    {
        return view('livewire.show-fixed-asset');
    }
}
