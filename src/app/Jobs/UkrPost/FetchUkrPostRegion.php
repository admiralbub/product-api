<?php

namespace App\Jobs\UkrPost;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Deliver;
use App\Models\UkrPostRegion;
use App\Enums\TypeDeliver;
class FetchUkrPostRegion implements ShouldQueue
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
    public function handle()
    {
        //$deliver = $this->deliver->available()->where('type',TypeDeliver::UKRPOSHTA)->latest()->first();
        $ch = curl_init();
        $authorization = "Authorization: Bearer ".$this->deliver->api_key_ukr_post; 
        curl_setopt($ch, CURLOPT_URL,$this->prefix.'/get_regions_by_region_ua');           
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json' , $authorization));
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            
        $response = curl_exec($ch);
            
        $resp_arr = array();
        $resp_arr = json_decode($response, true);
        curl_close($ch); 
        if (isset($resp_arr['Entries']['Entry'])) {
            foreach ($resp_arr['Entries']['Entry'] as $key => $value) {
                $region = new UkrPostRegion();
                $region->name = $value['REGION_UA'];
                $region->region_id = $value['REGION_ID'];

                $region->save();
            }
        } 
    }
}
