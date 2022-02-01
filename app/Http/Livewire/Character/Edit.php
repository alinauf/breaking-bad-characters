<?php

namespace App\Http\Livewire\Character;

use Livewire\Component;

class Edit extends Component
{
    const SHOW_ID_BREAKING_BAD = 1;
    const SHOW_ID_BETTER_CALL_SAUL = 2;

    public $character;
    public $name, $occupation, $nickname;
    public $formValidationStatus;
    public $status;
    public $statuses = [];
    public $selected_shows = [];
    public $shows;
    public $show_id;


    protected $rules = [
        'name' => 'required',
        'status' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Please enter a name for the character',
    ];


    public function mount($character)
    {
        $this->name = $character->name;
        $this->occupation = $character->occupation;
        $this->nickname = $character->nickname;
        $this->status = $character->status;

        $SHOW_ID_BREAKING_BAD = config('constants.SHOW_ID_BREAKING_BAD');
        $SHOW_ID_BETTER_CALL_SAUL = config('constants.SHOW_ID_BETTER_CALL_SAUL');
        $this->statuses = ['Alive', 'Deceased', 'Presumed dead	'];
        $this->shows = [$SHOW_ID_BREAKING_BAD => 'Breaking Bad', $SHOW_ID_BETTER_CALL_SAUL => 'Better Call Saul'];
        $this->formValidationStatus = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function validateForm()
    {
        if ($this->validate()) {
            $this->formValidationStatus = true;
        } else {
            $this->formValidationStatus = false;
        }
    }

    public function render()
    {
        return view('livewire.character.edit');
    }
}
