<?php

namespace App\Http\Livewire\Character;

use App\Services\QuoteService;
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

    public $quote;

    protected $rules = [
        'name' => 'required',
        'status' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Please enter a name for the character',
        'quote.required' => 'Please enter a quote for the character',

    ];


    public function mount($character)
    {
        $this->name = $character->name;
        $this->occupation = $character->occupation;
        $this->nickname = $character->nickname;
        $this->status = $character->status;

        $SHOW_ID_BREAKING_BAD = config('constants.SHOW_ID_BREAKING_BAD');
        $SHOW_ID_BETTER_CALL_SAUL = config('constants.SHOW_ID_BETTER_CALL_SAUL');
        $this->statuses = ['Alive', 'Deceased', 'Presumed dead'];
        $this->shows = [$SHOW_ID_BREAKING_BAD => 'Breaking Bad', $SHOW_ID_BETTER_CALL_SAUL => 'Better Call Saul'];
        $this->formValidationStatus = false;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addQuote()
    {
        $validatedData = $this->validate(
            [
                'quote' => 'required',
            ]
        );
        if ($this->quote != null && $this->quote != '') {
            $service = new QuoteService();
            $data['quote'] = $this->quote;
            $data['character_id'] = $this->character->id;
            $data['show_id'] = $this->character->shows[0]->id;
            $response = $service->storeQuote($data);

            if ($response['status']) {
                return redirect('characters/' . $this->character->id)->back()->with('success', 'Quote has been successfully created');
            } else {
                return redirect('characters/' . $this->character->id)->back()->with('failure', 'There was an issue adding the quote');
            }

        } else {
            return redirect('characters/' . $this->character->id)->back()->with('failure', 'There was no quote added');
        }
    }

    public function removeQuote($quoteId)
    {
        $service = new QuoteService();
        $response = $service->deleteQuote($quoteId);
        if ($response['status']) {
            return redirect('characters/' . $this->character->id)->back()->with('success', 'Quote has been successfully deleted');
        } else {
            return redirect('characters/' . $this->character->id)->back()->with('failure', 'There was an issue deleting the quote');
        }

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
