<?php

namespace App\Orchid\Layouts\Basket;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use App\Models\Basket;
use Orchid\Screen\Actions\Button;

class BasketListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'basket';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')
                ->render(function (Basket $basket){
                    return $basket->user->id;
            }),
            TD::make(__('full name'))
                ->render(function (Basket $basket){
                    return $basket->user->last_name.' '.$basket->user->first_name.' '.$basket->user->middle_name;
            }),
            TD::make(__('Phone_title'))
                ->render(function (Basket $basket){
                    return $basket->user->phone;
            }),
            TD::make('Email')
                ->render(function (Basket $basket){
                    return $basket->user->email;
            }),
            TD::make('', '')->width(70)
                 ->render(function (Basket $basket) {
                     return Link::make("")->icon('eye')
                        ->route('platform.baskets.edit', $basket);
                 }),
        ];
    }
}
