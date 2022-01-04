<?php

namespace App\Console\Commands;

use App\Models\Medicine;
use Illuminate\Console\Command;

class ExpiredMedicine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medicine:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Expired Medicines';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Medicine::where('expiration_day', '<=', now())
        ->update(['isExpired' => 1]);
        // info("something");
        return 0;
    }
}
