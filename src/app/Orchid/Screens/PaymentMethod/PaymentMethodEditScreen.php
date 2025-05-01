<?php

namespace App\Orchid\Screens\PaymentMethod;

use App\Models\PaymentMethod;

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
use App\Enums\TypePaymentMethod;


use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;

class PaymentMethodEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $pay_method;
    public function query(PaymentMethod $pay_method): array
    {
        return [
            'pay_method' => $pay_method
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->pay_method->exists ? $this->pay_method->name : __("Add").' '.__('Payment options');
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
                ->canSee(!$this->pay_method->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->pay_method->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->pay_method->exists),
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
                Input::make('pay_method.name_ru')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ru)'])),
                Input::make('pay_method.name_ua')
                    ->required()
                    ->title(__('Heading',['locale'=>'(ua)'])),
                CKEditor::make('pay_method.description_ru')
                    ->title(__('Description',['locale'=>'(ru)']))
                    ->rows(5),
                CKEditor::make('pay_method.description_ua')
                     ->title(__('Description',['locale'=>'(ua)']))
                     ->rows(5),
                Select::make('pay_method.type')
                     ->fromEnum(TypePaymentMethod::class,'getDescription')
                     ->title(__('Type')),    
                CheckBox::make('pay_method.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish'))
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->pay_method->fill($request->get('pay_method'))->save();
        
        $title_operation = $this->pay_method->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.pay_method.edit',$this->pay_method->id);
    }
    public function remove()
    {

        $this->pay_method->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.pay_methods.list');
    }
}
