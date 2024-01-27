<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Question as ModelsQuestion;

class Question extends Component
{
    //#[Rule('required', message:'Debe escribir un comentario')] // Add this line to replace the old validate attribute
    public $message;

    public $model;

    public $questions;

    public $question_edit = [
        'id' => null,
        'body' => ''
    ];

    public function mount(){
        $this->getQuestions();
    }

    public function getQuestions(){
        $this->questions = $this->model->questions()->orderBy('created_at', 'desc')->get();
    }

    public function store(){

        $this->validate([
            'message' => 'required'
        ]);
        $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => auth()->id()
        ]);
        $this->message = '';
        $this->getQuestions();
    }

    public function edit($question_id){
        $question = ModelsQuestion::find($question_id);
        $this->question_edit = [
            'id' => $question->id,
            'body' => $question->body
        ];

        $this->getQuestions();
    }

    public function update(){

        $this->validate(
            [
                'question_edit.body' => 'required'
            ],
            [
                'question_edit.body.required' => 'Debe escribir un comentario'
            ]
        );

        $question = ModelsQuestion::find($this->question_edit['id']);
        $question->update([
                'body' => $this->question_edit['body']
            ]);
        $this->resetValidation();    
        $this->getQuestions();
        $this->reset('question_edit'); // Reset the question_edit property (id and body
    }

    public function cancel(){
        $this->reset('question_edit'); // Reset the question_edit property (id and body
        $this->resetValidation();
        $this->getQuestions();
    }

    public function destroy($id){
        $question = ModelsQuestion::find($id);
        $question->delete();
        $this->getQuestions();
        $this->reset('question_edit'); // Reset the question_edit property (id and body
    }

    public function render()
    {
        return view('livewire.question');
    }
}
