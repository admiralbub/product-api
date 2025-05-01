<?php

namespace App\Orchid\Screens\Faq;

use Orchid\Screen\Screen;
use File;
use Carbon\Carbon;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\URL;

use App\Models\Faq;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\CheckBox;
use Nakipelo\Orchid\CKEditor\CKEditor;
class FaqEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $faq;

    public function query(Faq $faq): array
    {
        return [
            'faq' => $faq
        ];
    }
    public function name(): ?string
    {
        return $this->faq->exists ? $this->faq->question : __('Add').' FAQ';
    }
    public function commandBar(): iterable
    {
         return [
            Button::make(__('Add'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->faq->exists),

            Button::make(__('Edit'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->faq->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->faq->exists),
        ];
    }
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('faq.question_ua')
                    ->required()
                    ->title(__('Question field',['locale'=>'ua'])),

                Input::make('faq.question_ru')
                    ->required()
                    ->title(__('Question field',['locale'=>'ru'])),

                CKEditor::make('faq.answer_ua')
                    ->required()
                    ->title(__('Answer field',['locale'=>'ua'])),

                CKEditor::make('faq.answer_ru')
                    ->required()
                    ->title(__('Answer field',['locale'=>'ru'])),

                CheckBox::make('faq.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish')),      
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {

        $this->faq->fill($request->get('faq'))->save();

        $title_operation = $this->faq->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.faq.edit',$this->faq->id);
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove()
    {

        $this->faq->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.faqs.list');
    }
}
