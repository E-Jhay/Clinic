<?php

namespace App\Botman;

use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation{
    public function askHelp(){
        $this->say('1. Faculty in charge');
        $this->say('2. Available Time');
        $this->say('3. Location of the clinic');
        $this->say('4. Services');
        $this->ask('Please, Reply with the corresponding numbers.. (1, 2, 3,4)', [
            [
                'pattern' => '.*1|Faculty incharge|faculty|incharge.*',
                'callback' => function () {
                    $this->say('PSU - ACC current school nurse is Mrs. Michelle Lacson');
                    $this->say('You can message her through Facebook... Just search Michelle Lacson!');
                    $this->say('Type EXIT to ask again');
                }
            ],
            [
                'pattern' => '.*2|time|Available time|available|availabilty.*',
                'callback' => function () {
                    $this->say('The school nurse is available on Monday, Wednesday, Friday from 8:00 AM to 4:00 PM');
                    $this->say('Type EXIT to ask again');
                }
            ],
            [
                'pattern' => '.*3|location|where.*',
                'callback' => function () {
                    $this->say('The location of the clinic in the school is at the New Building near NB 9 room');
                    $this->say('Type EXIT to ask again');
                }
            ],
            [
                'pattern' => '.*4|services|What are the services.*',
                'callback' => function () {
                    $this->say('The medical services rendered are the following');
                    $this->say('Consultation / Diagnosis and Treatment of Diseases');
                    $this->say('Issuance of Medical Certificate and Medical Clearance');
                    $this->say('Referral of cases to consultants or Specialist for further evaluation');
                    $this->say('Referral of cases to tertiary Hospital for Admission/Confinement');
                    $this->say('BMI Measurement');
                    $this->say('Assist/ Accompany Athletes & University Officials during Sports Events');
                    $this->say('BP Monitoring/ BP Taking');
                    $this->say('Type EXIT to ask again');
                }
            ]
        ]);
    }
    public function run()
    {
        // This will be called immediately
        $this->askHelp();
    }
}
?>