<?php

namespace App\Actions\FoundCheaper;
use App\Models\FoundCheaper;
class FoundCheaperAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $foundCheaperData): FoundCheaper
    {
        $foundCheaper = FoundCheaper::create($foundCheaperData);
        
        return $foundCheaper;
        
    }
}