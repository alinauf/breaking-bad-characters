<?php

namespace App\Http\Livewire\Character;

use Livewire\Component;

class Create extends Component
{
    const SHOW_ID_BREAKING_BAD = 1;
    const SHOW_ID_BETTER_CALL_SAUL = 2;


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


    public function mount()
    {
        $SHOW_ID_BREAKING_BAD = config('constants.SHOW_ID_BREAKING_BAD');
        $SHOW_ID_BETTER_CALL_SAUL = config('constants.SHOW_ID_BETTER_CALL_SAUL');
        $this->statuses = ['Alive', 'Deceased', 'Presumed dead	'];
        $this->shows = [$SHOW_ID_BREAKING_BAD => 'Breaking Bad', $SHOW_ID_BETTER_CALL_SAUL => 'Better Call Saul'];
        $this->status = 'Alive';
        $this->formValidationStatus = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function validateForm()
    {
        if (count($this->selected_shows) < 1) {
            session()->now('checkbox_validation_error', 'Please select at least one show');
        } else {
            if ($this->validate()) {
                $this->formValidationStatus = true;
            } else {
                $this->formValidationStatus = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.character.create');
    }
}
