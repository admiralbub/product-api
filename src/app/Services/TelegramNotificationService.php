<?php
namespace App\Services;
 
use App\Interfaces\TelegramNotificationInterface;
use App\Models\Order;
use Telegram\Bot\Api;

class TelegramNotificationService implements TelegramNotificationInterface {

    private $token;
    public function __construct() {
        $this->token = settings('telegram_notification_token');
        $this->chat_id = settings('chat_telegram_notification');
    }
    public function sendTelegramNotificationToAdminChannel($type, $id_order) {
        $ip_address = request()->ip();
        $orders = Order::findOrFail($id_order);
        $message = "Новый заказ\n"
            . "<b>ФИО:</b> {$orders->first_name} {$orders->	last_name}\n"
            . "<b>Тип:</b> {$type}\n"
            . "<b>Дата:</b> {$orders->created_at}\n"
            . "<b>Телефон: {$orders->phone}\n</b>"
            . "<b>ip: {$ip_address}\n</b>";

       
        foreach($orders->products as $product) {
            $message .= "{$product->name_ua} по цене {$product->pivot->price} грн, {$product->pivot->quantity} шт.\n";
        }

        $telegram = new Api($this->token);
        $response = $telegram->sendMessage([
            'chat_id' => $this->chat_id, 
            'parse_mode' => 'HTML',
            'text' => $message
        ]);
    }
}

?>