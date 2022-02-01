<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Services\API\BreakingBadAPI;
use App\Services\CharacterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CharacterController extends Controller
{
    /*
    * @var App\Services\CharacterService
    */
    private $characterService;

    /**
     * Constructor.
     * @param CharacterService $characterService
     */
    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view(
            'characters.index'
        );
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view(
            'characters.create'
        );
    }


    /**
     * @param CharacterRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CharacterRequest $request)
    {
        $result = $this->characterService->storecharacter($request->all());

        if ($result['status']) {
            $result['character']->id;

            return redirect('characters')->with('success', $result['payload']);
        } else {
            return redirect()->back()->with('failure', $result['payload']);
        }
    }

    /**
     * Display the specified resource.
     * @param Character $character
     * @return Application|Factory|View
     */
    public function show(Character $character)
    {
        $breakingBadAPI = new BreakingBadAPI;

        $deathInformation = 'NA';
        $deathsCaused = 'NA';

        // Get Character's Death Information
        if (str_replace(' ', '', $character->status) != 'Alive' && str_replace(' ', '', $character->status) != 'Unknown') {
            $response = $breakingBadAPI->getCharactersDeathInformation($character->name);
            if ($response['status']) {
                $deathInformation = isset($response['data'][0]) ? $response['data'][0] : 'NA';
            }
        }

        $response = $breakingBadAPI->getCharactersDeathsCausedCount($character->name);
        if ($response['status']) {
            $deathsCaused = isset($response['data'][0]) ? $response['data'][0] : 'NA';
        }
        return view(
            'characters.show',
            [
                'character' => $character,
                'deathInformation' => $deathInformation,
                'deathsCaused' => $deathsCaused
            ]
        );
    }


    /**
     * @param character $character
     * @return Application|Factory|View
     */
    public function edit(character $character)
    {
        return view(
            'characters.edit', ['character' => $character]
        );
    }

    /**
     * @param CharacterRequest $request
     * @param Character $character
     * @return Application|RedirectResponse|Redirector
     */
    public function update(CharacterRequest $request, character $character)
    {
        //
        $result = $this->characterService->updatecharacter($character->id, $request->all());

        if ($result['status']) {
            return redirect("characters/$character->id")->with('success', $result['payload']);
        } else {
            return redirect()->back()->with('failure', $result['payload']);
        }
    }


    /**
     * @param character $character
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(character $character)
    {
        //
        $result = $this->characterService->deletecharacter($character->id);

        if ($result['status']) {
            return redirect('characters')->with('success', $result['payload']);
        } else {
            return redirect()->back()->with('failure', $result['payload']);
        }
    }
}
