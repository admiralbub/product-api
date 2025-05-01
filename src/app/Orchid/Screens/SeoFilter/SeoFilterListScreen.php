<?php

namespace App\Orchid\Screens\SeoFilter;

use Orchid\Screen\Screen;
use App\Models\SeoFilter;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\SeoFilter\SeoFilterListLayout;
class SeoFilterListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'seo_filter' => SeoFilter::orderBy('id','DESC')->paginate()
        ];
        
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Seo filter');
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
                ->route('platform.seo-filters.create')
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
            SeoFilterListLayout::class
        ];
    }
    public function remove_seo_filter(Request $request): void
    {
        SeoFilter::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
