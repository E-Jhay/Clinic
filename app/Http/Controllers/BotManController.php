<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Botman\OnboardingConversation;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BotmanController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = resolve('botman');

        $botman->hears('Hi.*', function ($botman) {
            $botman->typesAndWaits(1);
            $botman ->reply('Hello! you can ask me about the school clinic. Type OK to know what you can ask..');

        });
        $botman->hears('EXIT.*', function ($botman) {
            $botman->typesAndWaits(1);
            $botman->reply('You can ask about the following:');
            $botman-> startConversation(new OnboardingConversation);
        });

        $botman->hears('.*ok|okay .*', function ($botman){
            $botman->typesAndWaits(1);
            $botman->reply('I can answer only basic information though...');
            $botman->reply('You can ask about the following:');
            $botman-> startConversation(new OnboardingConversation);

        });
        $botman->hears('.*thanks|thank you.*', function ($botman){
            $botman->typesAndWaits(2);
            $botman->reply('Welcome! say hi again if you want to ask.');
        });

        $botman -> hears('COVID-19 Active cases Updates {active}', function ($botman, $active){
            $url = 'https://covid-19.dataflowkit.com/v1'.urlencode($active);
            $response = json_decode(file_get_contents($url));

            $botman -> reply('The current active cases in the world is ' .$response->Active->Country_text.'is:' );
            $botman->reply($response->Total ->Cases_text);
        });

        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I cannot understand..');
            $bot->reply("Say hi");
        });
        
        $botman->listen();
    }
}