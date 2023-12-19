<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;

class Meeting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:meeting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $comments = Comment::where('date',date('Y-m-d'))->get();
        foreach($comments as $comment){
            $find = Comment::find($comment->id);
            $find->comment = 'Found You';
            $find->save();
        }
    }
}
