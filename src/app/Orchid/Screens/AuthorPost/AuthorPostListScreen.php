<?php

namespace App\Orchid\Screens\AuthorPost;

use Orchid\Screen\Screen;
use App\Models\AuthorPost;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\AuthorPost\AuthorPostListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class AuthorPostListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'author_blogs' => AuthorPost::orderBy('id','DESC')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Author blog');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.pencil')
                ->route('platform.author_blog.create')
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
            AuthorPostListLayout::class
        ];
    }
    public function remove_author_post(Request $request): void
    {
        AuthorPost::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
