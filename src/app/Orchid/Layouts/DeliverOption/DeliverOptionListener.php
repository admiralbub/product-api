<?php

namespace App\Orchid\Layouts\DeliverOption;

use Illuminate\Http\Request;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use App\Models\Deliver;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Input;
use App\Enums\TypeDeliver;
use Orchid\Support\Facades\Layout;


class DeliverOptionListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'deliver.type',
        'deliver.api_key_ukr_post',
        'deliver',
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
                Select::make('deliver.type')
                    ->empty("No value")
                    ->fromEnum(TypeDeliver::class,'getDescription')
                    ->title(__('Type')),    

                Input::make('deliver.api_key_ukr_post')
                    ->canSee($this->query->get('deliver.type')===TypeDeliver::UKRPOSHTA)
                    ->title(__('Api Key')),
            ]),
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
            ->set('deliver.type', $request->input('deliver.type'))
            
            ->set('deliver.api_key_ukr_post', $request->input('deliver.api_key_ukr_post'))
            ->set('deliver', $request->input('deliver'));
    }
}
