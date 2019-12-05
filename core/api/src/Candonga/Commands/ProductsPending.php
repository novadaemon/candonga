<?php

namespace Candonga\Commands;

use Candonga\Notifications\ProductsPendingEmail;
use App\User;
use Candonga\Entities\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProductsPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:pending {weeks=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find products on “pending” for a week or more. {weeks : Number of weeks}';

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
     * @return mixed
     */
    public function handle()
    {
        $weeks = (int) $this->argument('weeks');

        $this->comment(sprintf('Finding products with status "pending" before than %d week(s)', $weeks));

        $last_day = Carbon::now()->sub("{$weeks} weeks")->format('Y-m-d');

        $products = Product::whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') < '{$last_day}'")->get();

        if($products->count() > 0){
            $this->info(sprintf('There are %d product(s)', $products->count()));
            /**
             * Notify user
             */
            User::first()->notify(new ProductsPendingEmail($products, $weeks));

        }else{
            $this->info(sprintf('There are not products "pending" before %d week(s)', $weeks));
        }


    }
}
