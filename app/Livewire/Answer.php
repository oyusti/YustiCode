<?php

namespace App\Livewire;

use Livewire\Component;

class Answer extends Component
{

    public $question;

    public $cant = 0;

    public $answer_create = [
        'open' => false,
        'body' => ''
    ];

    public $answer_to_answer = [
        'body' => '',
        'id' => null
    ];

    public function getAnswersProperty(){
        return $this->question->answers()->get()->take($this->cant * (-1));
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

        $this->cant += 1;
        
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
    }

    public function show_answer(){
        if($this->cant < $this->question->answers()->count()){
            $this->cant = $this->question->answers()->count();
        }else{
            $this->cant = 0;
        }
    }

    public function render(){
        return view('livewire.answer');
    }
}
