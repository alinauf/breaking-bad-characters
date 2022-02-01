<?php

namespace App\Console\Commands;

use App\Models\Character;
use App\Models\Quote;
use App\Models\ShowCharacter;
use App\Services\API\BreakingBadAPI;
use Illuminate\Console\Command;

class PopulateDatabase extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:characters-and-quotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make calls to the Breaking Bad APIs to fetch the list of all characters and quotes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $breakingBadAPI = new BreakingBadAPI;

        // Fetch All Characters and store them
        $response = $breakingBadAPI->getAllCharacters();
        if ($response['status']) {
            $characters = $response['data'];
            foreach ($characters as $character) {
                $savedCharacter = Character::create([
                    'name' => $character->name,
                    'occupation' => isset($character->occupation[0]) ? $character->occupation[0] : null,
                    'nickname' => isset($character->nickname) ? $character->nickname : null,
                    'status' => $character->status,
                    'img_url' => isset($character->img) ? $character->img : null,
                ]);

                // Based on appearance count add to the Show Characters Table
                if (count($character->appearance) > 0) {
                    ShowCharacter::create([
                        'character_id' => $savedCharacter->id,
                        'show_id' => config('constants.SHOW_ID_BREAKING_BAD'),
                    ]);
                }

                // Based on appearance count add to the Show Characters Table
                if (count($character->better_call_saul_appearance) > 0) {
                    ShowCharacter::create([
                        'character_id' => $savedCharacter->id,
                        'show_id' => config('constants.SHOW_ID_BETTER_CALL_SAUL'),
                    ]);
                }

            }
            $this->line('Characters are populated along with their relationship to the shows');
        }

        // Fetch All Quotes and store them
        $response = $breakingBadAPI->getAllQuotes();
        if ($response['status']) {
            $quotes = $response['data'];
            foreach ($quotes as $quote) {
                $character = Character::where('name', $quote->author)->orWhere('nickname', $quote->author)->first();
                if ($character != null) {

                    if ($quote->series == 'Better Call Saul') {
                        $show_id = config('constants.SHOW_ID_BETTER_CALL_SAUL');
                    } else {
                        $show_id = config('constants.SHOW_ID_BREAKING_BAD');
                    }

                    Quote::create([
                        'quote' => $quote->quote,
                        'character_id' => $character->id,
                        'show_id' => $show_id,
                    ]);
                }
            }
            $this->line('Quotes are populated.');
        }

    }
}
