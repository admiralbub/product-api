<?php

namespace App\Orchid\Layouts\Deliver;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use App\Models\Order;
use App\Models\Deliver;
use App\Models\NpCity;
use App\Models\NpWarehouse;

use App\Models\UkrPostCity;

use App\Models\UkrPostWarehouse;

use App\Enums\TypeDeliver;

class DeliverListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'order.deliver_type',
        'order.np_city_id',
        'order.ukr_post_city_id',
        'order.ukr_post_warehouse_id',
        'order'
    ];

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    protected function layouts(): array
    {
        return [
            Layout::rows([
                Select::make('order.deliver_type')
                    ->options(Order::getDeliverListTypeAttribute())
                    ->required()
                    ->title(__('Deliver')), 

                Relation::make('order.np_city_id')
                    ->fromModel(NpCity::class, 'Description')
                    ->allowEmpty()
                    ->canSee($this->query->get('order.deliver_type')===TypeDeliver::NP->name 
                        || $this->query->get('order.deliver_type')===TypeDeliver::NP_COURIER->name)
                    ->title(__('City')),

                Relation::make('order.np_warehouse_id')
                    ->fromModel(NpWarehouse::class, 'Description')
                    ->applyScope('Ref',$this->query->get('order.np_city_id'))
                    ->allowEmpty()
                    ->canSee($this->query->get('order.deliver_type')===TypeDeliver::NP->name)
                    ->title(__('Warehouse')),
                
                Input::make('order.np_self_address')
                    ->required()
                    ->canSee($this->query->get('order.deliver_type')===TypeDeliver::SELF_DELIVERY->name)
                    ->title(__('Address')),

                Input::make('order.np_courier_address')
                    ->required()
                    ->canSee($this->query->get('order.deliver_type')===TypeDeliver::NP_COURIER->name)
                    ->title(__('Address')),
                
                Relation::make('order.ukr_post_city_id')
                    ->fromModel(UkrPostCity::class, 'name')
                    ->allowEmpty()
                    ->canSee($this->query->get('order.deliver_type')===TypeDeliver::UKRPOSHTA->name)
                    ->title(__('City')),

                Relation::make('order.ukr_post_warehouse_id')
                    ->fromModel(UkrPostWarehouse::class, 'address')
                    ->allowEmpty()
                    ->canSee($this->query->get('order.deliver_type')===TypeDeliver::UKRPOSHTA->name)
                    ->title(__('Warehouse')),
                
              
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
            ->set('order.deliver_type', $request->input('order.deliver_type'))
            
            ->set('order.np_city_id', $request->input('order.np_city_id'))
            ->set('order', $request->input('order'));
    }
}
