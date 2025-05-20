<?php

namespace App\Orchid\Layouts\FoundCheaper;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\FoundCheaper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use App\Orchid\Fields\Rate;

class FoundCheaperListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'found_cheaper';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID'),
            TD::make('name', __('firstName_title')),
            TD::make('phone', __('Phone_title')),
            TD::make('', __('Products'))
                ->render(function (FoundCheaper $foundcheaper) {
                    return Menu::make(__('Link'))
                        ->url(route('product.view',$foundcheaper->product->slug));
                }),
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->align(TD::ALIGN_RIGHT),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (FoundCheaper $foundcheaper) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.found_cheaper.edit', $foundcheaper->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_found_cheaper', [
                                'id' => $foundcheaper->id,
                            ]),
                    ])),
           
        ];
    }
}
