<?php

namespace App\Jobs\UkrPost;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Enums\TypeDeliver;
use App\Models\Deliver;
use App\Models\UkrPostRegion;
use App\Models\UkrPostCity;
use App\Models\UkrPostWarehouse;
use File;

class FetchUkrPostWarehouse implements ShouldQueue
{
    use Queueable;

    private $prefix = "https://www.ukrposhta.ua/address-classifier-ws";
    /**
     * Create a new job instance.
     */
    private $deliver;
    public function __construct()
    {
        $this->deliver = Deliver::available()->where('type',TypeDeliver::UKRPOSHTA)->latest()->first();
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $regions = UkrPostRegion::all();
        $hest = [];
        foreach($regions as $region) {
            $ch = curl_init();
            $authorization = "Authorization: Bearer ".$this->deliver; 
       	 	curl_setopt($ch, CURLOPT_URL, $this->prefix.'/get_postoffices_by_city_id?region_id='.$region->region_id);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json' , $authorization));
        	curl_setopt($ch, CURLOPT_HEADER, 0);

        	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        
        	$response = curl_exec($ch);
        	$resp_arr = array();
       // $response = json_decode($response);
        	curl_close($ch); 




            $warehouses = json_decode($response, true);
            if (isset($warehouses['Entries']) && isset($warehouses['Entries']['Entry'])) {
                foreach ($warehouses['Entries']['Entry'] as $key => $item) {
                    if ($item['LOCK_CODE'] == "0") {
                        $district = new UkrPostWarehouse();
                        $district->postindex = $item['POSTINDEX'];
                        $district->region_id = $item['REGION_ID'];
                        $district->district_id = $item['DISTRICT_ID'];
                        $district->city_id = $item['CITY_ID'];
                        $district->address = "Відділення №".$item['POSTINDEX'].' '.$item['ADDRESS'];
                        $district->save();
                    }
                }
            } else {
                // Можно залогировать или вывести, чтобы понять что пришло
                File::append("/var/www/chystagriadka/public/log.txt", json_encode($warehouses));
            }
        }
    }
}
