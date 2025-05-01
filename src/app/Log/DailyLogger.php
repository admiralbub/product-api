<?php
namespace App\Log;
use Carbon\Carbon;
use File;
class DailyLogger {

    public function __construct(public $request, public string $directory,public string $prefix ) {

    }
    public function log() {
        $filename = Carbon::now()->format('Y-m-d') . '_' . $this->prefix.'.txt';
        $path = $this->directory . '/' . $filename;
        if (!File::exists($this->directory)) {
            File::makeDirectory($this->directory);
        }

        $logEntry = '[' . now()->format('H:i:s') . '] ' . $this->request . PHP_EOL;

        // Добавляем запись
        File::append($path, $logEntry);

    }


}
?>