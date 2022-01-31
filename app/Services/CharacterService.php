<?php

namespace App\Services;

use App\Models\Character;
use Illuminate\Support\Facades\DB;

class CharacterService
{

    public function __construct()
    {
        //
    }

    // Fetch all characters. If search filter has value fetch all characters filtered by search
    public function listCharacters($search)
    {
        return Character::where('name', 'like', '%' . $search . '%')->orWhere('nickname', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    // Create and store a character
    public function storeCharacter($data)
    {

        DB::beginTransaction();

        try {
            $character = Character::create([
                'name' => $data['name'],
                'occupation' => $data['occupation'] ?? null,
                'nickname' => $data['nickname'] ?? null,
                'status' => $data['status'],
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //throw $e;

            return ['status' => false, 'payload' => 'There was an issue with saving the character'];
        }

        DB::commit();

        return ['status' => true, 'payload' => 'The character has been successfully created'];
    }

    // Find and update character
    public function updateCharacter($characterId, $data)
    {
        DB::beginTransaction();

        $character = Character::where('id', $characterId)
            ->first();

        try {
            $character->name = $data['name'] ?? $character->name;
            $character->occupation = $data['occupation'] ?? null;
            $character->nickname = $data['nickname'] ?? null;
            $character->status = $data['status'] ?? $character->status;
            $characterSave = $character->save();
        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => false, 'payload' => 'There was an error with updating the character'];
        }

        DB::commit();

        if ($characterSave) {
            return ['status' => true, 'payload' => 'Character has been successfully updated'];

        } else {
            return ['status' => false, 'payload' => 'There was an issue with updating the character'];
        }
    }

    // Fetch specific Character
    public function showCharacter($characterId)
    {
        $character = Character::where('id', $characterId)
            ->first();

        if ($character) {
            return ['status' => true, 'payload' => $character];
        } else {
            return ['status' => false, 'payload' => 'There was an issue with fetching the character'];
        }

    }

    // Delete Character
    public function deleteCharacter($characterId)
    {
        DB::beginTransaction();
        $character = Character::where('id', $characterId)
            ->first();

        try {
            $character->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => false, 'payload' => 'There was an issue deleting the character'];
        }

        DB::commit();
        return ['status' => true, 'payload' => 'Character has been deleted'];

    }


}
