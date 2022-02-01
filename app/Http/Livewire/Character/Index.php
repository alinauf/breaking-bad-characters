<?php

namespace App\Http\Livewire\Character;

use App\Services\CharacterService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search;
    public $isBreakingBadShow;

    public function mount()
    {

        $this->isBreakingBadShow;
    }


    public function render()
    {
        $service = new CharacterService();
        $data = $service->listCharacters($this->search);

        return view('livewire.character.index',['characters'=>$data]);
    }

}
