<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;

class Homescreen extends Component
{
    public function render()
    {
    
        return view('livewire.layout.homescreen')
        ->extends('layouts.app')
        ->section('content');

    }
}
