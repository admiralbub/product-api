<?php

namespace App\Orchid\Screens\BlogComment;

use App\Models\BlogComment;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Menu;
use App\Orchid\Fields\RateInput;

class BlogCommentEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $blog_comment;
    public function query(BlogComment $blog_comment): array
    {
        return [
            'blog_comment' => $blog_comment
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Comments under the blog').' #'.$this->blog_comment->id;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make( __("Edit"))
                ->icon('bs.pencil')
                ->method('createOrUpdate'),

            Button::make(__('Remove'))
                ->icon('trash')
                ->method('remove')
                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')),
        
            Menu::make(__('Show'))
                ->icon('bs.eye-fill')
                ->canSee($this->blog_comment->exists)
                ->url('/blog/'.$this->blog_comment->posts->slug),     
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
                
                Input::make('blog_comment.user_name')
                    ->required()
                    ->title('firstName_title'),
                Input::make('blog_comment.email')
                    ->required()
                    ->title('Email'),
                Input::make('blog_comment.phone')
                    ->required()
                    ->title('Phone_title'),
                TextArea::make('blog_comment.comment')
                    ->required()
                    ->title(__('Comment')),




                CheckBox::make('blog_comment.available')
                    ->sendTrueOrFalse()
                    ->title(__("Publish")),
            ])
        ];
    }
    public function createOrUpdate(Request $request)
    {
        $this->blog_comment->fill($request->get('blog_comment'))->save();

        $title_operation = $this->blog_comment->exists ? __("You have successfully completed the record changes.") : __("You have successfully completed adding a record."); 
        Toast::info($title_operation);

        return redirect()->route('platform.blog_comment.edit',$this->blog_comment->id);
    }
    public function remove()
    {

        $this->blog_comment->delete();

        Toast::info(__('You have successfully performed the delete operation.'));

        return redirect()->route('platform.blog_comments.list');
    }
}
