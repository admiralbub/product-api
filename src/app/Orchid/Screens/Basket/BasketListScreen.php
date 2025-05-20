<?php

namespace App\Orchid\Screens\Basket;

use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use App\Models\Basket;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Layouts\Basket\BasketListLayout;
use Illuminate\Support\Facades\DB;
class BasketListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $sub = DB::table('baskets')
            ->selectRaw('MAX(id) as id')
            ->groupBy('user_id');
        return [
            'basket' => Basket::whereIn('id', $sub)->OrderBy('id','DESC')->paginate(15)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Basket');
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
    public function layout(): array
    {
        return [
    
            BasketListLayout::class
        ];
    }
   
}
