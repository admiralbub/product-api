<?php

namespace App\Orchid\Screens\SeoFilter;

use App\Models\SeoFilter;
use App\Models\Category;
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
use Orchid\Screen\Actions\Menu;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;
use App\Orchid\Layouts\SeoFilterTemplate\SeoFilterTemplateListener;
use App\Enums\SeoFilterAttrGroup;

class SeoFilterEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $seo_filter;
    public function query(SeoFilter $seo_filter): array
    {
        return [
            'seo_filter' => $seo_filter
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->seo_filter->exists ? __("Edit seo attribut for filter",["number"=>$this->seo_filter->id]) : __("Add seo attribut for filter");
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
                ->canSee(!$this->seo_filter->exists),
            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->seo_filter->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->seo_filter->exists),
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
            Layout::tabs([
                __('Basic information') => [
                    Layout::rows([
                        Input::make('seo_filter.name_filter')
                            ->required()
                            ->title(__('Name')),
                
    

                        CheckBox::make('seo_filter.no_index')
                            ->sendTrueOrFalse()
                            ->title(__('Do not index the filter')),
                            
                        CheckBox::make('seo_filter.available')
                            ->sendTrueOrFalse()
                            ->title(__('Publish')."?"),

                        CheckBox::make('seo_filter.is_template')
                            ->sendTrueOrFalse()
                            ->title(__('Activate templates for product filter meta tags')),
                        
                    ]),
                    SeoFilterTemplateListener::class,
                   
                ],
            
                'SEO' => [
                    Layout::rows([
                        Input::make('seo_filter.h1_ru')
                            ->required()
                            ->title('H1 (ru)'),
                        Input::make('seo_filter.h1_ua')
                            ->required()
                            ->title('H1 (ua)'),

                        Input::make('seo_filter.meta_title_ru')
                            ->required()
                            ->title('Title (ru)'),
                        Input::make('seo_filter.meta_title_ua')
                            ->required()
                            ->title('Title (ua)'),
                        TextArea::make('seo_filter.meta_description_ru')
                            ->required()
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('seo_filter.meta_description_ua')
                            ->required()
                            ->title('Meta description (ua)')
                            ->rows(5),

                        TextArea::make('seo_filter.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('seo_filter.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],
            ])
        ];
    }
    public function containsKeywords($url) {
        foreach (SeoFilterAttrGroup::cases() as $case) {
            if (str_contains($url, $case->value)) {
                return true;
            }
        }
        return false;
    }
    public function createOrUpdate(Request $request)
    {   
        if($request->get('seo_filter')['is_template'] == "0") {
            if($this->containsKeywords($request->get('seo_filter')['url']) == false) {
                Toast::error(__('In this url there is no prefix for product filters'));
                return redirect()->route('platform.seo-filter.edit',$this->seo_filter->id);
            }
        }
        $this->seo_filter->fill($request->get('seo_filter'))->save();

        $title_operation = $this->seo_filter->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.seo-filter.edit',$this->seo_filter->id);
    }
    public function remove()
    {


         $this->seo_filter->delete();

         Toast::info(__('You have successfully performed the delete operation.'));
         return redirect()->route('platform.seo-filters.list');
    }
}
