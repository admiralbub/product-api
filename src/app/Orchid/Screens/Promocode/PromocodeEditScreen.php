<?php

namespace App\Orchid\Screens\Promocode;

use App\Models\Promocode;
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
use App\Models\Brand;
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Fields\DateTimer;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;
use App\Orchid\Layouts\PromocodeType\PromocodeTypeListener;
class PromocodeEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $promocode;
    public function query(Promocode $promocode): array
    {
        return [
            'promocode' => $promocode
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->promocode->exists ? __('Edit').' '.__('Promocode').' №'.$this->promocode->id : __('Create').' '.__('Promocode');
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
                ->canSee(!$this->promocode->exists),
            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->promocode->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->promocode->exists),
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
                Input::make('promocode.name_promocode')
                    ->required()
                    ->title(__('Name')),
                Input::make('promocode.code')
                    ->required()
                    ->title(__('Promocode')),
                Input::make('promocode.min_total_activation')
                    ->title(__('Minimum order amount for activation')),
                CheckBox::make('promocode.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish')."?"),
                DateTimer::make('promocode.start_promocode_date')
                    ->allowInput()
                    ->required()
                    ->title(__('Start date activation')),
                DateTimer::make('promocode.end_promocode_date')
                    ->allowInput()
                    ->required()
                    ->title(__('End date activation')),
                
            ]),
            PromocodeTypeListener::class
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->promocode->fill($request->get('promocode'))->save();

        $title_operation = $this->promocode->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.promocode.edit',$this->promocode->id);
    }
    public function remove()
    {

        $this->promocode->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.promocodes.list');
    }
}
