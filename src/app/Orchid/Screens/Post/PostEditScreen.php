<?php

namespace App\Orchid\Screens\Post;

use App\Models\Post;
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
use App\Models\AuthorPost;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\CheckBox;

class PostEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $post;
    public function query(Post $post): array
    {
        return [
            'post' => $post
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->post->exists ? __("Edit blog" ).' #'.$this->post->id : __("Add blog");
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
                ->canSee(!$this->post->exists),

            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate')
                ->canSee($this->post->exists),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->canSee($this->post->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::tabs([
                __('Basic information') => [
                    Layout::rows([
                        Input::make('post.name_ru')
                            ->required()
                            ->title(__('Heading',['locale'=>'(ru)'])),
                        Input::make('post.name_ua')
                             ->required()
                             ->title(__('Heading',['locale'=>'(ua)'])),

                        Picture::make('post.img')
                              ->title(__('Image'))
                              ->storage('images_blog'),
                        CKEditor::make('post.description_ru')
                             ->title(__('Description',['locale'=>'(ru)']))
                             ->rows(5),
                        CKEditor::make('post.description_ua')
                              ->title(__('Description',['locale'=>'(ua)']))
                              ->rows(5),
                        Select::make('post.author_id')
                              ->fromModel(AuthorPost::available(), 'name_ua')
                              ->title(__('Author blog')),
                        CheckBox::make('post.available')
                             ->sendTrueOrFalse()
                             ->title(__('Publish'))
                             
                    
                    ]),
                ],
                 'SEO' => [
                    Layout::rows([
                        Input::make('post.h1_ru')
                            ->title('H1 (ru)'),
                        Input::make('post.h1_ua')
                            ->title('H1 (ua)'),

                        Input::make('post.meta_title_ru')
                            ->title('Title (ru)'),
                        Input::make('post.meta_title_ua')
                            ->title('Title (ua)'),
                        TextArea::make('post.meta_description_ru')
                            ->title('Meta description (ru)')
                            ->rows(5),
                        TextArea::make('post.meta_description_ua')
                            ->title('Meta description (ua)')
                            ->rows(5),

                         TextArea::make('post.meta_keywords_ru')
                            ->title('Keywords (ru)')
                            ->rows(5),
                        TextArea::make('post.meta_keywords_ua')
                            ->title('Keywords (ua)')
                            ->rows(5),
                    ]),
                ],

            ])
        ];
    }

    public function createOrUpdate(Request $request)
    {
        $this->post->fill($request->get('post'))->save();

        $title_operation = $this->post->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.post.edit',$this->post->id);
    }
    public function remove()
    {

        $this->post->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.posts.list');
    }
}
