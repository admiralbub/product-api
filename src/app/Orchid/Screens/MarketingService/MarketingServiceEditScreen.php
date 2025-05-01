<?php

namespace App\Orchid\Screens\MarketingService;

use App\Models\MarketingService;
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
use App\Enums\PlacementScript;
class MarketingServiceEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $marketing_service;
    public function query(MarketingService $marketing_service): array
    {
        return [
            'marketing_service' => $marketing_service
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->marketing_service->exists ? __("Edit").' '.$this->marketing_service->name : __("Add");
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
                ->canSee(!$this->marketing_service->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->marketing_service->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->marketing_service->exists),
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
                Input::make('marketing_service.name')
                    ->required()
                    ->title(__('Name')),
                TextArea::make('marketing_service.script')
                    ->title(__('Initialization code')),
                Select::make('marketing_service.placement')
                    ->fromEnum(PlacementScript::class,'getDescription')
                    ->title(__('Location')),    
                CheckBox::make('marketing_service.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish'))
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->marketing_service->fill($request->get('marketing_service'))->save();

        $title_operation = $this->marketing_service->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.marketing-service.edit',$this->marketing_service->id);
    }
    public function remove()
    {

        $this->marketing_service->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.marketing-services.list');
    }
}
