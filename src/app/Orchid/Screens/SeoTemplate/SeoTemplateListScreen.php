<?php

namespace App\Orchid\Screens\SeoTemplate;

use Orchid\Screen\Screen;
use App\Models\SeoTemplate;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\SeoTemplate\SeoTemplateListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class SeoTemplateListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'seo_templates' => SeoTemplate::orderBy('id','DESC')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Seo template');
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
                ->route('platform.seo-templates.create')
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
            SeoTemplateListLayout::class
        ];
    }
    public function remove_seo_template(Request $request): void
    {
        SeoTemplate::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
