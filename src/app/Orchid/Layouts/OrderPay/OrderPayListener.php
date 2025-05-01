<?php

namespace App\Orchid\Layouts\OrderPay;

use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use App\Models\Order;
use App\Enums\TypePaymentMethod;
class OrderPayListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'order.pay_type',
        'order.type_installment',
        'order'
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
                Select::make('order.pay_type')
                    ->options(Order::getPayListTypeAttribute())
                    ->required()
                    ->title(__('Payment method')), 
                Input::make('order.credit_count')
                    ->required()
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::INSTALLMENT_PRIVATBANK->name)
                    ->title(__('Number of payments')),

                Input::make('order.type_installment')
                    ->readonly()
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::INSTALLMENT_PRIVATBANK->name)
                    ->title(__('Type credit')),
                Input::make('order.pay_amount')
                    ->readonly()
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::LIQPAY->name)
                    ->title(__('total pay')),

                Input::make('order.edrpu_legal')
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::LEGAL_ACCOUNT_CURRENT->name)
                    ->title(__('ЄДРПОУ')),
                Input::make('order.full_name_legal')
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::LEGAL_ACCOUNT_CURRENT->name)
                    ->title(__('Full name of the legal entity')),
                Input::make('order.full_name_acount')
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::INDIVIDUALS_ACCOUNT_CURRENT->name)
                    ->title(__('full name')),
                Input::make('order.tin_acount')
                    ->canSee($this->query->get('order.pay_type')===TypePaymentMethod::INDIVIDUALS_ACCOUNT_CURRENT->name)
                    ->title(__('TIN')),

    
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
            ->set('order.pay_type', $request->input('order.pay_type'))
            ->set('order', $request->input('order'));
    }
}
