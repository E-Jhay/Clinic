<?php

use App\Http\Controllers\BotManController;

    $botman = resolve('botman');

    //Define botman commands
    $botman -> hears('Hi!', function($bot){
        $bot->reply('Hello!');
    });

    $botman -> fallback(function ($bot){
        $bot -> reply('Sorry I cannot understand you...');
    });
    $botman->hears('Start Conversation', BotManController::class.'@startConversation')
?>