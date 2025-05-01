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
use App\Models\UkrPostDistrict;


class FetchUkrPostDistrict implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
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
       	 	curl_setopt($ch, CURLOPT_URL,'https://www.ukrposhta.ua/address-classifier-ws/get_districts_by_region_id_and_district_ua?region_id='.$region->region_id);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json' , $authorization));
        	curl_setopt($ch, CURLOPT_HEADER, 0);

        	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        
        	$response = curl_exec($ch);
        	$resp_arr = array();
       // $response = json_decode($response);
        	curl_close($ch); 
            $districts = json_decode($response, true);
            foreach($districts['Entries']['Entry'] as $key => $item) {
                $district = new UkrPostDistrict();
                $district->name = $item['DISTRICT_UA'];
                $district->region_id = $item['REGION_ID'];
                $district->district_id = $item['DISTRICT_ID'];
                $district->save();
            }
        }
    }
}
