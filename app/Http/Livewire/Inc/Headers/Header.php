<?php

namespace App\Http\Livewire\Inc\Headers;

use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('livewire.inc.headers.header')->extends('layouts.app')->section('content');
    }
}
