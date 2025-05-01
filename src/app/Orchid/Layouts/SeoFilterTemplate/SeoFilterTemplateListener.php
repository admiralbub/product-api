<?php

namespace App\Orchid\Layouts\SeoFilterTemplate;

use Illuminate\Http\Request;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Screen\Fields\Input;
use App\Models\SeoFilter;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Select;
use App\Enums\TypeFilterSeo;


class SeoFilterTemplateListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'seo_filter',
        'seo_filter.is_template'
    ];

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('seo_filter.url')
                    ->required()
                    ->help(__('Filter_title_value'))
                    ->canSee($this->query->get('seo_filter.is_template')==false)
                    ->title(__('Filter values (link)')),

                CKEditor::make('seo_filter.description_ua')
                    ->canSee($this->query->get('seo_filter.is_template')==false)
                    ->title(__('Description',['locale'=>'(ua)']))
                    ->rows(5),
                        
                CKEditor::make('seo_filter.description_ru')
                    ->canSee($this->query->get('seo_filter.is_template')==false)
                    ->title(__('Description',['locale'=>'(ru)']))
                    ->rows(5),
                    
                Select::make('seo_filter.type_filter')
                    ->canSee($this->query->get('seo_filter.is_template')==true)
                    ->fromEnum(TypeFilterSeo::class,'getDescription')
                    ->title(__('Apply a filter to'))
                    ->required(),
            ])
        ];
    }

    /**
     * Update state
     *
     * @param \Orchid\Screen\Repository $repository
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Orchid\Screen\Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        return $repository
            ->set('seo_filter.is_template', $request->input('seo_filter.is_template'))
            ->set('seo_filter', $request->input('seo_filter'));
    }
}
