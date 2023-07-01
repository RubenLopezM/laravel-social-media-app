<?php

namespace App\Providers;

use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\CommentRepository;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

}
