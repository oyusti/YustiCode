<?php

namespace App\Livewire;

use Livewire\Component;

class Answer extends Component
{

    public $question;

    public $answers; 

    public $answer_create = [
        'open' => false,
        'body' => ''
    ];

    public $answer_to_answer = [
        'body' => '',
        'id' => null
    ];

    public function mount(){
        $this->getAnswer();
    }

    public function getAnswer(){
        $this->answers = $this->question->answers()->get();
    }

    public function store(){
        
        $this->validate([
            'answer_create.body' => 'required'
        ],[
            'answer_create.body.required' => 'Debe escribir un comentario'
        ]);

        $this->question->answers()->create([
            'body' => $this->answer_create['body'],
            'user_id' => auth()->id()
        ]);

        $this->reset('answer_create');
        
        //$this->question = $this->question->fresh();
    }

    public function answer_to_answer_store(){
        $this->validate([
            'answer_to_answer.body' => 'required'
        ],[
            'answer_to_answer.body.required' => 'Debe escribir un comentario'
        ]);

        $this->question->answers()->create([
            'body' => $this->answer_to_answer['body'],
            'user_id' => auth()->id(),
        ]);

        $this->reset('answer_to_answer');

        $this->getAnswer();
    }

    public function render(){
        return view('livewire.answer');
    }
}
