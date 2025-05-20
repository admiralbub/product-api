<?php

namespace App\Orchid\Layouts\Basket;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Basket;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;

class BasketProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'basket_product';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', __('ID'))->width(20),
            TD::make(__('Name'))->width(220)->render(function (Basket $basket) {
                return '<a href="/product/'.$basket->products->slug.'">'.$basket->products->name.'</a>';
                
            }),
            TD::make(__('Pack'))->width(70)->render(function (Basket $basket) {
                return $basket->products->packs()->first()->name;
                
                
            }),
            TD::make(__('Price'))->width(70)->render(function (Basket $basket) {
                return $basket->products->price * $basket->products->packs()->first()->volume;
                
            }),
            TD::make(__('Quantity'))->width(70)->render(function (Basket $basket) {
                return $basket->quantity;
                
            }),
        ];
    }
}
