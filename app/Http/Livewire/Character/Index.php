<?php

namespace App\Http\Livewire\Character;

use App\Services\CharacterService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search;
    public $category;
    public $isBreakingBadShow = false;
    public $isBetterCallSaul = false;

    public function toggleBreakingBad()
    {
        $this->isBetterCallSaul = false;
    }

    public function toggleBetterCallSaul()
    {
        $this->isBreakingBadShow = false;
    }

    public function render()
    {

        if ($this->isBreakingBadShow) {
            $category = 'Breaking Bad';
            $this->isBetterCallSaul = false;
        } elseif ($this->isBetterCallSaul) {
            $category = 'Better Call Saul';
            $this->isBreakingBadShow = false;
        } else {
            $category = 'showAll';
            $this->isBetterCallSaul = false;
            $this->isBreakingBadShow = false;
        }


        // Query and fetch all users based on search
        $service = new CharacterService();
        $data = $service->listCharacters($this->search, $category);

        return view('livewire.character.index', ['characters' => $data]);
    }

}
