<?php

namespace App\Providers;

use App\Services\CommentService;
use App\Services\FollowService;
use App\Services\LikeService;
use App\Services\MessageService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('user-service',function($app){
            return new UserService();
        });       
        $this->app->bind('post-service',function($app){
            return new PostService();
        });        
        $this->app->bind('like-service',function($app){
            return new LikeService();
        });   
        $this->app->bind('follow-service',function($app){
            return new FollowService();
        });       
          $this->app->bind('comment-service',function($app){
            return new CommentService();
        });
        $this->app->bind('message-service',function($app){
            return new MessageService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
