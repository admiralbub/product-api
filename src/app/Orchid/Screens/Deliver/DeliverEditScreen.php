<?php

namespace App\Orchid\Screens\Deliver;

use App\Models\Deliver;

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
use App\Orchid\Layouts\DeliverOption\DeliverOptionListener;

class DeliverEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $deliver;
    public function query(Deliver $deliver): array
    {
        return [
            'deliver' => $deliver
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->deliver->exists ? __("Edit").' '.$this->deliver->name : __("Add") .' : '.__("Deliver");
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Create"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->deliver->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->deliver->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->deliver->exists),
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
            DeliverOptionListener::class,
            Layout::rows([
                Input::make('deliver.name_ru')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ru)'])),
                Input::make('deliver.name_ua')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ua)'])),
                CKEditor::make('deliver.description_ru')
                    ->title(__('Description',['locale'=>'(ru)']))
                    ->rows(5),
                CKEditor::make('deliver.description_ua')
                     ->title(__('Description',['locale'=>'(ua)']))
                     ->rows(5),
               
                CheckBox::make('deliver.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish'))

                
            ]),
            
        ];
    }
    public function createOrUpdate(Request $request)
    {
        if($request->get('deliver')['type'] == 5) {
            $deliver['api_key_ukr_post'] = $request->get('deliver')['api_key_ukr_post'];
        }
        $this->deliver->option = $deliver;
        $this->deliver->fill($request->get('deliver'))->save();
        
        $title_operation = $this->deliver->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.deliver.edit',$this->deliver->id);
    }
    public function remove()
    {

        $this->deliver->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.delivers.list');
    }
}
