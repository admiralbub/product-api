<?php

namespace App\Orchid\Screens\AuthorPost;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Models\AuthorPost;
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

class AuthorPostEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $author_blog;
    public function query(AuthorPost $author_blog): array
    {
        return [
            'author_blog' => $author_blog
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->author_blog->exists ? __("Edit").' '.__('Blog author').' #'.$this->author_blog->id : __('Add').' '.__('Blog author');
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
                ->canSee(!$this->author_blog->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->author_blog->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->author_blog->exists),
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
                Input::make('author_blog.name_ru')
                    ->required()
                    ->title(__('Name of Author').' (RU)'),
                Input::make('author_blog.name_ua')
                    ->required()
                    ->title(__('Name of Author').' (UA)'),
                Picture::make('author_blog.img')
                    ->title(__('Image'))
                    ->required()
                    ->storage('images_author'),
                CKEditor::make('author_blog.description_ua')
                    ->title(__('Description',['locale'=>'(ua)']))
                    ->rows(5),
                        
                CKEditor::make('author_blog.description_ru')
                    ->title(__('Description',['locale'=>'(ru)']))
                    ->rows(5),

                CheckBox::make('author_blog.available')
                    ->sendTrueOrFalse()
                    ->title(__('Publish')),   
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {

        $this->author_blog->fill($request->get('author_blog'))->save();

        $title_operation = $this->author_blog->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.author_blog.edit',$this->author_blog->id);
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove()
    {

        $this->author_blog->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.author_blogs.list');
    }
}
