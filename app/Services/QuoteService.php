<?php

namespace App\Services;

use App\Models\Quote;
use Illuminate\Support\Facades\DB;

class QuoteService
{

    public function __construct()
    {
        //
    }

    // Create and store a quote
    public function storeQuote($data)
    {
        DB::beginTransaction();
        try {
            $quote = Quote::create([
                'quote' => $data['quote'],
                'character_id' => $data['character_id'],
                'show_id' => $data['show_id'],
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            //throw $e;

            return ['status' => false, 'payload' => 'There was an issue with saving the quote'];
        }

        DB::commit();

        return ['status' => true, 'payload' => 'The quote has been successfully created'];
    }

    // Find and update quote
    public function updateQuote($quoteId, $data)
    {
        DB::beginTransaction();

        $quote = Quote::where('id', $quoteId)
            ->first();

        try {
            $quote->quote = $data['quote'] ?? $quote->quote;
            $quote->character_id = $data['character_id'] ?? $quote->character_id;
            $quote->show_id = $data['show_id'] ?? $quote->show_id;
            $quoteSave = $quote->save();
        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => false, 'payload' => 'There was an error with updating the quote'];
        }

        DB::commit();

        if ($quoteSave) {
            return ['status' => true, 'payload' => 'Quote has been successfully updated'];

        } else {
            return ['status' => false, 'payload' => 'There was an issue with updating the quote'];
        }
    }

    // Fetch specific Quote
    public function showQuote($quoteId)
    {
        $quote = Quote::where('id', $quoteId)
            ->first();

        if ($quote) {
            return ['status' => true, 'payload' => $quote];
        } else {
            return ['status' => false, 'payload' => 'There was an issue with fetching the quote'];
        }

    }

    // Delete Quote
    public function deleteQuote($quoteId)
    {
        DB::beginTransaction();
        $quote = Quote::where('id', $quoteId)
            ->first();

        try {
            $quote->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => false, 'payload' => 'There was an issue deleting the quote'];
        }
        DB::commit();
        return ['status' => true, 'payload' => 'Quote has been deleted'];
    }


}
