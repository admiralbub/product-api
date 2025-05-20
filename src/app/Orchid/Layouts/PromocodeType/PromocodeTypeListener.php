<?php

namespace App\Orchid\Layouts\PromocodeType;

use Illuminate\Http\Request;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use App\Models\Product;
use App\Enums\TypePromocode;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Input;

class PromocodeTypeListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'promocode.type_promocode',
        'promocode',
        'promocode.fixed_price'
    ];

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    protected function layouts(): iterable
    {

        return [
           
            Layout::rows([
             
                Select::make('promocode.type_promocode')
                    ->fromEnum(TypePromocode::class,'getDescription')
                    ->empty("No value")
                    ->title(__('Type')),    
                Input::make('promocode.fixed_price')
                    ->canSee($this->query->get('promocode.type_promocode')==TypePromocode::FIXED_PRICE->value)
                    ->title(__('Fixed amount')),
                Input::make('promocode.percentage_price')
                    ->canSee($this->query->get('promocode.type_promocode')==TypePromocode::PERCENTAGE_DISCOUNT->value)
                    ->title(__('Percentage discount')),
                Select::make('promocode.product_id')
                    ->fromModel(Product::available(), 'name_ua')
                    ->empty(__('Select the required item'))
                    ->canSee($this->query->get('promocode.type_promocode')==TypePromocode::GIFT_PRODUCT->value)
                    ->title(__('A gift when ordering')), 
            ]),
        ];
    }

    /**
     * Update state
     *
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        return $repository
            ->set('promocode.type_promocode', $request->input('promocode.type_promocode'))
            
            ->set('promocode', $request->input('promocode'));
    }
}
