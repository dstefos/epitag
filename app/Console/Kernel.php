<?php

namespace App\Console;

use App\Models\bundle;
use App\Models\card;
use App\Models\TradeJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $jobs=TradeJob::where('active', true)->get();
            foreach($jobs as $job){
                print('Start job '.$job->id);
                $product=$job->card_id!=null?card::find($job->card_id):bundle::find($job->bundle_id);
                $price=$product->price;
                $user=User::find($job->user_id);
                if(now()>new Carbon($job->when) || $price<$job->whenPriceSmaller || $price>$job->whenPriceBigger){
                    if($job->card_id!=null){
                        $job->active=false;
                        $product->trade($user);
                        print("Card ".$product->id." bought by ".$job->user_id.". Active:".$job->active);
                    }else if($job->bundle_id!=null){
                        $job->active=false;
                        $product->boughtBy($user);
                        print("Bundle ".$product->id." bought by ".$job->user_id.". Active:".$job->active);
                    }
                }
                $job->save();
                print('End job '.$job->id);
            }
        })->everyMinute();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
