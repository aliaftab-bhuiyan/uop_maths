<?php

namespace App\Providers;

use App\Models\Keyword;
use App\Repos\Interfaces\QuestionRepoInterface;
use App\Repos\QuestionRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            QuestionRepoInterface::class,
            QuestionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $top_keywords = Keyword::withCount('questions')
            ->orderByDesc('questions_count')
            ->take(10)
            ->get();
        View::share('top_keywords', $top_keywords);
    }
}
