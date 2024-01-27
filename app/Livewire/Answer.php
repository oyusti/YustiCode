<?php

namespace App\Livewire;

use Livewire\Component;

class Answer extends Component
{

    public $question;

    public $question_create = [
        'open' => false,
        'body' => ''
    ];

    public function render()
    {
        return view('livewire.answer');
    }
}
