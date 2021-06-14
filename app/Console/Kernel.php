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
            date_default_timezone_set('Europe/Athens');
            $jobs=TradeJob::where('active', true)->get();
            foreach($jobs as $job){
                print('Start job '.$job->id);
                // print('Test 1');
                $product=$job->card_id!=null?card::find($job->card_id):bundle::find($job->bundle_id);
                // print('Test 2');
                $price=$product->price;
                // print('Test 3');
                $user=User::find($job->user_id);
                // print('Test 4');
                
                $timeCondition=$job->whenTime!=null?(now()>new Carbon($job->whenTime)):false;
                $priceSmaller=$job->whenPriceSmaller!=null?$price<$job->whenPriceSmaller:false;
                $priceBigger=$job->whenPriceBigger!=null?$price<$job->whenPriceBigger:false;
                print($timeCondition.'-'.$priceSmaller.'-'.$priceBigger);
                if($timeCondition || $priceSmaller || $priceBigger){
                    if($job->card_id!=null){
                        // print('Test 6');
                        $job->active=false;
                        // print('Test 7');
                        $product->trade($user);
                        // print('Test 8');
                        print("Card ".$product->id." bought by ".$job->user_id.". Active:".$job->active);
                        // print('Test 9');
                    }else if($job->bundle_id!=null){
                        // print('Test 10');
                        $job->active=false;
                        // print('Test 12');
                        $product->boughtBy($user);
                        // print('Test 13');
                        print("Bundle ".$product->id." bought by ".$job->user_id.". Active:".$job->active);
                        // print('Test 14');
                    }
                    // print('Test 15');
                }
                // print('Test 16');
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
