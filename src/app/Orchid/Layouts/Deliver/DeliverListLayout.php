<?php

namespace App\Orchid\Layouts\Deliver;

use App\Models\Deliver;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Actions\Menu;

class DeliverListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'delivers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            
            TD::make('id', 'ID')->sort()->width(80),
            TD::make('name', __('Name'))
                ->render(function (Deliver $deliver) {
                    return   $deliver->name;
                }),
            TD::make('type', __('Type'))->width(120)
                ->render(function (Deliver $deliver) {
                    return   $deliver->type->getDescription();
                }),
            TD::make('available', __('Status'))->sort()->width(80)
                ->render(function (Deliver $deliver) {
                    if ($deliver->available == 1) {
                        return "<span class=\"badge bg-success  text-white\" >".__('Active')."</span>";
                    } else {
                        return "<span class=\"badge bg-danger text-white\">".__('No active')."</span>";
                    }
                
                }),   
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->sort()
                ->align(TD::ALIGN_RIGHT), 
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Deliver $deliver) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.deliver.edit', $deliver->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_deliver', [
                                'id' => $deliver->id,
                            ]),

                    ])),   
        ];
    }
}
