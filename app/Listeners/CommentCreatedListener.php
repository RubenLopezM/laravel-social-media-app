<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Notifications\PostCommented;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'commentListener';

    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $comment = $event->comment;
        $post = $comment->post;
        $post->loadCount('comments');
        
        if ($post->comments_count % 5 === 0) {
            $post->user->notify(new PostCommented($post));
        }
    }
}
