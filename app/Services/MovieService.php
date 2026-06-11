<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MovieService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('omdb.api_key');
    }

    public function search($query, $page = 1)
    {
        try {
            if (empty($this->apiKey)) {
                Log::warning('OMDB API key is missing.');
                return [
                    'movies' => [],
                    'total'  => 0,
                    'error'  => 'OMDB API key belum diatur.',
                ];
            }

            $baseUrl = config('omdb.base_url', 'https://www.omdbapi.com/');
            $response = Http::withoutVerifying()->get($baseUrl, [
                'apikey' => $this->apiKey,
                's'      => $query,
                'page'   => $page,
                'type'   => 'movie',
            ]);

            if ($response->failed()) {
                Log::error('OMDB search request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'movies' => [],
                    'total' => 0,
                    'error' => 'Gagal menghubungi OMDB API.',
                ];
            }

            $data = $response->json() ?? [];

            if (($data['Response'] ?? null) === 'True') {
                return [
                    'movies' => $data['Search'],
                    'total'  => (int) $data['totalResults'],
                    'error'  => null,
                ];
            }

            return [
                'movies' => [],
                'total'  => 0,
                'error'  => $data['Error'],
            ];
        } catch (\Exception $e) {
            Log::error('OMDB error: ' . $e->getMessage());
            return false;
        }
    }

    public function detail($imdbId)
    {
        try {
            if (empty($this->apiKey)) {
                Log::warning('OMDB API key is missing for detail request.');
                return false;
            }

            $baseUrl = config('omdb.base_url', 'https://www.omdbapi.com/');
            $response = Http::withoutVerifying()->get($baseUrl, [
                'apikey' => $this->apiKey,
                'i'      => $imdbId,
                'plot'   => 'full',
            ]);

            if ($response->failed()) {
                Log::error('OMDB detail request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return false;
            }

            $data = $response->json() ?? [];

            Log::info('OMDB detail response', $data);

            if (($data['Response'] ?? null) === 'True') {
                return $data;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('OMDB detail error: ' . $e->getMessage());
            return false;
        }
    }
}