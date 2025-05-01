<?php

namespace App\Orchid\Screens\BlogComment;

use Orchid\Screen\Screen;
use App\Models\BlogComment;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\BlogComment\BlogCommentListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class BlogCommentListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'blog_comments' => BlogComment::orderBy('id','DESC')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Comments under the blog');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            BlogCommentListLayout::class
        ];
    }
    public function remove_blog_comment(Request $request): void
    {
        BlogComment::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
