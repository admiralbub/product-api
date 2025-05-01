<?php

namespace App\Orchid\Screens\Faq;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Orchid\Layouts\Faq\FaqListLayout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
class FaqListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'faq' => Faq::orderBy('id','DESC')->paginate()
        ];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('FAQ');
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
                ->route('platform.faqs.create')
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
            FaqListLayout::class
        ];
    }
    public function remove_faq(Request $request): void
    {
        Faq::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
