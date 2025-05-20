<?php

namespace App\Orchid\Screens\FoundCheaper;


use Orchid\Screen\Screen;
use App\Models\FoundCheaper;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class FoundCheaperEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $foundcheaper;

    public function query(FoundCheaper $foundcheaper): array
    {
        return [
            'foundcheaper' => $foundcheaper
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('FOUND CHEAPER').' #'.$this->foundcheaper->id;
    }

    public function commandBar(): array
    {
        return [
            Button::make(__("Edit"))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->foundcheaper->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->foundcheaper->exists),
      
            Menu::make(__('Link'))
                ->icon('fire')
                ->route('product.view', $this->foundcheaper->product->slug),    
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('foundcheaper.name')
                    ->title(__('firstName_title'))
                    ->require(),

                Input::make('foundcheaper.phone')
                    ->title(__('Phone_title'))
                    ->mask('+38(999) 999-99-99')
                    ->require(),

                Input::make('foundcheaper.url')
                    ->title(__('Url found product'))
                    ->require(),

                Menu::make(__('Link').' - '.$this->foundcheaper->product->name)
                    ->route('product.view', $this->foundcheaper->product->slug),    

                TextArea::make('foundcheaper.comment')
                    ->title(__('Comment'))
                    ->require(),



            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {

        $this->foundcheaper->fill($request->get('foundcheaper'))->save();

        $title_operation = $this->foundcheaper->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.found_cheaper.edit',$this->foundcheaper->id);
    }
    public function remove()
    {

        $this->foundcheaper->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.found_cheapers.list');
    }
   
}
