<?php

namespace App\Orchid\Screens\FoundCheaper;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use App\Models\FoundCheaper;
use App\Orchid\Layouts\FoundCheaper\FoundCheaperListLayout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;

class FoundCheaperListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'found_cheaper' => FoundCheaper::orderBy('id','DESC')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('FOUND CHEAPER');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
            FoundCheaperListLayout::class
        ];
    }
    public function remove_found_cheaper(Request $request): void
    {
        FoundCheaper::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
