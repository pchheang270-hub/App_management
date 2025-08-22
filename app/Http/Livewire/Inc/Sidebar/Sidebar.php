<?php

namespace App\Http\Livewire\Inc\Sidebar;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.inc.sidebar.sidebar')->extends('layouts.app')->section('content');
    }
}
