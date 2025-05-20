<?php

namespace App\Orchid\Layouts\BanUser;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\BanUser;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;

class BanUserListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'ban_users';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort()->width(120),
            TD::make('name', __("Name")),
            TD::make('phone', __("Phone_title")),
            TD::make('email', __("Email")),
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->width(120)
                ->align(TD::ALIGN_RIGHT),  
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (BanUser $ban_user) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
 
                        Link::make(__('Edit'))
                            ->route('platform.ban_user.edit', $ban_user->id)
                            ->icon('bs.pencil'),
 
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove_ban_user', [
                                'id' => $ban_user->id,
                            ]),
                    ])), 
        ];
    }
}
