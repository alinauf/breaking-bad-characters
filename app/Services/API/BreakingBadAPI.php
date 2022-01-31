<?php

namespace App\Services\API;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BreakingBadAPI
{

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('constants.BREAKING_BAD_API_BASE_URL');
    }

    /**
     * Make a GET request to fetch all the Characters in Breaking Bad and Better Call Saul
     * @return array
     * @throws RequestException
     */
    public function getAllCharacters(): array
    {
        try {
            Log::info('GET ' . $this->baseUrl . 'characters');
            $response = Http::get($this->baseUrl . 'characters');

            if ($response->successful()) {
                return ['status' => true, 'data' => $response->body()];
            }

            $status400Above = $response->failed();
            $status400 = $response->clientError();
            $status500 = $response->serverError();

            if ($status400Above || $status400 || $status500) {
                Log::error('Response Status: ' . $response->status());
                Log::error('Response Body: ' . $response->body());
                $response->throw();
            }

        } catch (\Exception $e) {
            Log::error('Error ' . $e);
        }

    }

    /**
     * Make a GET request to fetch all the Quotes by characters in Breaking Bad and Better Call Saul
     * @return array
     * @throws RequestException
     */
    public function getAllQuotes(): array
    {
        try {
            Log::info('GET ' . $this->baseUrl . 'quotes');
            $response = Http::get($this->baseUrl . 'quotes');

            if ($response->successful()) {
                return ['status' => true, 'data' => $response->body()];
            }


            $status400Above = $response->failed();
            $status400 = $response->clientError();
            $status500 = $response->serverError();

            if ($status400Above || $status400 || $status500) {
                Log::error('Response Status: ' . $response->status());
                Log::error('Response Body: ' . $response->body());
                $response->throw();
            }

        } catch (\Exception $e) {
            Log::error('Error ' . $e);
        }

    }


}
