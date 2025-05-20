<?php

namespace App\Orchid\Screens\Basket;

use Orchid\Screen\Screen;
use App\Models\Basket;
use App\Models\User;
use App\Models\Product;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use App\Orchid\Layouts\Basket\BasketProductListLayout;
class BasketEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $basket;
    public $basket_product;
    public function query(Basket $basket): array
    {   

        return [
            'basket' => $basket->user,
            'basket_product'=> Basket::where('user_id',$basket->user_id)->get()
            
        ];

        
    }


    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */

    public function name(): ?string
    {
        return __('Basket').' #'.$this->basket->id;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('basket.last_name')
                    ->readonly()
                    ->title(__('lastName_title').''),
                Input::make('basket.first_name')
                    ->readonly()
                    ->title(__('firstName_title').''),
                Input::make('basket.middle_name')
                    ->readonly()
                    ->title(__('MiddleName_title').''),
                Input::make('basket.phone')
                    ->readonly()
                    ->title(__('Phone_title').''),
                Input::make('basket.email')
                    ->readonly()
                    ->title(__('Email').''),
            ]),
            BasketProductListLayout::class
        ];
    }
}
