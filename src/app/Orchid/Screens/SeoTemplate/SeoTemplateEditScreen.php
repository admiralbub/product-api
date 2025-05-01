<?php

namespace App\Orchid\Screens\SeoTemplate;

use App\Models\SeoTemplate;
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
use App\Enums\TypeSeoTemplate;
class SeoTemplateEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $seo_template;
    public function query(SeoTemplate $seo_template): array
    {
        return [
            'seo_template' => $seo_template
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->seo_template->exists ? __("Edit").' '.$this->seo_template->title : __("Add");
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
                ->canSee(!$this->seo_template->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->seo_template->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->seo_template->exists),
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
                Input::make('seo_template.title')
                    ->required()
                    ->title(__('Name')),
                Input::make('seo_template.h1_ru')
                    ->title('H1 (ru)'),
                Input::make('seo_template.h1_ua')
                    ->title('H1 (ua)'),

                Input::make('seo_template.meta_title_ru')
                    ->title('Title (ru)'),
                Input::make('seo_template.meta_title_ua')
                    ->title('Title (ua)'),
                TextArea::make('seo_template.meta_description_ru')
                    ->title('Meta description (ru)')
                    ->rows(5),
                TextArea::make('seo_template.meta_description_ua')
                    ->title('Meta description (ua)')
                    ->rows(5),

                TextArea::make('seo_template.meta_keywords_ru')
                    ->title('Keywords (ru)')
                    ->rows(5),
                TextArea::make('seo_template.meta_keywords_ua')
                    ->title('Keywords (ua)')
                    ->rows(5),
                Select::make('seo_template.type')
                    ->fromEnum(TypeSeoTemplate::class,'getDescription')
                    ->title(__('Apply seo templates to')),    
                CheckBox::make('seo_template.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish')),
            ]),
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->seo_template->fill($request->get('seo_template'))->save();
        
        $title_operation = $this->seo_template->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.seo-templates.edit',$this->seo_template->id);
    }
    public function remove()
    {

        $this->seo_template->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.seo-templates.list');
    }
}
