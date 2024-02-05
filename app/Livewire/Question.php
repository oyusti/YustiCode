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

    public $cant = 5;

    public $caja_comentario = true;

    public $question_edit = [
        'id' => null,
        'body' => ''
    ];

    /* public function mount(){
        $this->getQuestions();
    } */

    public function getQuestionsProperty(){
        return $this->model->questions()->take($this->cant)->orderBy('created_at', 'desc')->get();
    }

    /* public function getQuestions(){
        $this->questions = $this->model->questions()->take($this->cant)->orderBy('created_at', 'desc')->get();
    } */

    public function store(){
        
        /* $this->validate([
            'message' => 'required'
        ]); */
        $this->model->questions()->create([
            'body' => $this->message,
            'user_id' => auth()->id()
        ]);
        $this->message = '';

        $this->caja_comentario = false;
    }

    public function edit($question_id){
        $question = ModelsQuestion::find($question_id);
        $this->question_edit = [
            'id' => $question->id,
            'body' => $question->body
        ];
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
        //$this->resetValidation();    
        $this->reset('question_edit'); // Reset the question_edit property (id and body
    }

    public function cancel(){
        $this->reset('question_edit'); // Reset the question_edit property (id and body
        $this->resetValidation();
    }

    public function destroy($id){
        $question = ModelsQuestion::find($id);
        $question->delete();
        $this->reset('question_edit'); // Reset the question_edit property (id and body
    }

    public function show_more_questions(){
        $this->cant += 5;
    }

    public function render()
    {
        return view('livewire.question');
    }
}
