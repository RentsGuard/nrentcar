<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout')]
class HealthCheck extends Component
{
    public function render()
    {
        return view('livewire.health-check');
    }
}
