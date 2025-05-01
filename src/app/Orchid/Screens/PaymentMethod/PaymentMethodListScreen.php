<?php

namespace App\Orchid\Screens\PaymentMethod;

use Orchid\Screen\Screen;
use App\Models\PaymentMethod;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\PaymentMethod\PaymentMethodListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class PaymentMethodListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'pay_methods' => PaymentMethod::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Payment options');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.pencil')
                ->route('platform.pay_method.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            PaymentMethodListLayout::class
        ];
    }
    public function remove_pay_method(Request $request): void
    {
        PaymentMethod::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
