<?php

namespace App\Console\Commands\Basket;

use Illuminate\Console\Command;
use App\Interfaces\BasketInterface;

class SendBasketEmail extends Command
{

    public function __construct(private BasketInterface $basket) {
        parent::__construct();
     }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-basket-email';

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
        $this->basket->sendEmailBasketNotification();
    }
}
