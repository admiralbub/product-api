<?php

namespace App\Orchid\Screens\BanUser;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\BanUser;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;


class BanUserEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $ban_user;
    public function query(BanUser $ban_user): array
    {
        return [
            'ban_user' => $ban_user
        ];
    }


    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->ban_user->exists ? __("Ban users").':'.__("Edit").' #'.$this->ban_user->id : __('Add');

    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Add"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->ban_user->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->ban_user->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->ban_user->exists),
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
            Layout::rows([
                Input::make('ban_user.name')
                    ->title(__('firstName_title'))
                    ->require(),

                Input::make('ban_user.phone')
                    ->title(__('Phone_title'))
                    ->mask('+38(999)999-99-99')
                    ->require(),
                Input::make('ban_user.email')
                    ->title(__('Email'))
                    ->require(),
                
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {

        $this->ban_user->fill($request->get('ban_user'))->save();

        $title_operation = $this->ban_user->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.ban_user.edit',$this->ban_user->id);
    }
    public function remove()
    {

        $this->ban_user->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.ban_users.list');
    }
}
