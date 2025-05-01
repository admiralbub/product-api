<?php

namespace App\Orchid\Screens\Deliver;

use Orchid\Screen\Screen;
use App\Models\Deliver;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Deliver\DeliverListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class DeliverListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'delivers' => Deliver::paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Deliver');
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
                ->route('platform.deliver.create')
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
            DeliverListLayout::class
        ];
    }
    public function remove_deliver(Request $request): void
    {
        Deliver::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
