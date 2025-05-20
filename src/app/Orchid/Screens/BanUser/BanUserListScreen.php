<?php

namespace App\Orchid\Screens\BanUser;

use Orchid\Screen\Screen;
use App\Models\BanUser;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\BanUser\BanUserListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class BanUserListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'ban_users' => BanUser::orderBy('id','DESC')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Ban users');
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
                ->route('platform.ban_user.create')
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
            BanUserListLayout::class
        ];
    }
    public function remove_ban_user(Request $request): void
    {
        BanUser::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
