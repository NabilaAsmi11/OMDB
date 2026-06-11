<?php

namespace Tests\Feature;

use App\Http\Controllers\PanelControl\MovieController;
use App\Services\MovieService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MovieDetailViewTest extends TestCase
{
    public function test_detail_action_renders_existing_detail_view(): void
    {
        Schema::create('favorite', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('imdb_id');
            $table->string('title');
            $table->string('year')->nullable();
            $table->string('poster')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        $this->app->instance(MovieService::class, new class extends MovieService
        {
            public function detail($imdbId)
            {
                return [
                    'Title' => 'Test Movie',
                    'Year' => '2024',
                    'Runtime' => '120 min',
                    'Genre' => 'Action',
                    'Poster' => 'N/A',
                    'imdbID' => $imdbId,
                    'Plot' => 'Sample plot',
                    'Director' => 'Director',
                    'Writer' => 'Writer',
                    'Actors' => 'Actor',
                    'Language' => 'English',
                    'Country' => 'US',
                    'BoxOffice' => 'N/A',
                    'imdbRating' => '7.5',
                    'Ratings' => [],
                    'Metascore' => '75',
                    'Type' => 'movie',
                    'Response' => 'True',
                ];
            }
        });

        $view = app(MovieController::class)->detail('tt1234567');

        $this->assertInstanceOf(\Illuminate\View\View::class, $view);
        $this->assertSame('panel_control.components.detail.detail', $view->name());
        $this->assertStringContainsString('Test Movie', $view->render());
    }
}
