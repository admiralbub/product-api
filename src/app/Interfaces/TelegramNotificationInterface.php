<?php
namespace App\Interfaces;
interface TelegramNotificationInterface {
    public function sendTelegramNotificationToAdminChannel($type, $id_order);
}
?>