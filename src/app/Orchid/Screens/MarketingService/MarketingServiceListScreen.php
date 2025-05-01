<?php

namespace App\Orchid\Screens\MarketingService;

use Orchid\Screen\Screen;
use App\Models\MarketingService;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\MarketingService\MarketingServiceListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;



class MarketingServiceListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'marketing_services' => MarketingService::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Marketing services");
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
                ->route('platform.marketing-service.create')
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
            MarketingServiceListLayout::class
        ];
    }
    public function remove_marketing_list(Request $request): void
    {
        MarketingService::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
