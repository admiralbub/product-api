<?php
namespace App\Services;
 
use App\Interfaces\DeliverInterface;

use App\Models\Deliver; 

class DeliverService implements DeliverInterface {
    public function getListDeliver() {
        return Deliver::available()->get();
    }

}

?>