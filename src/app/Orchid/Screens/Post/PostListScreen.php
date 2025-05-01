<?php

namespace App\Orchid\Screens\Post;

use Orchid\Screen\Screen;
use App\Models\Post;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Post\PostListLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;


class PostListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'posts' => Post::orderBy('id','DESC')->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Blog');
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
                ->route('platform.post.create')
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
            PostListLayout::class
        ];
    }
    public function remove_post(Request $request): void
    {
        Post::findOrFail($request->get('id'))->delete();

        Toast::info(__('You have successfully performed the delete operation.'));
    }
}
