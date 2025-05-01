<?php

namespace App\Orchid\Screens\PaymentProvider;

use Orchid\Screen\Screen;
use App\Models\PaymentProvider;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class PaymentProviderScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'payment_providers' => PaymentProvider::get()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Payment systems');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate'),
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
            Layout::view('admin.setting.payment_provide')
        ];
    }
    public function createOrUpdate(Request $request)
    {
        //$test = [];
        //dd($request->get('setting'));
        foreach ($request->get('payment_provider') as $key => $value) {
            
            PaymentProvider::where('key', $key)->update(['value' => $value]);
        }
        $title_operation =  __("You have successfully completed the record changes."); 
        Toast::info($title_operation);
        return redirect()->route('platform.payment_providers.list');

    }
}
