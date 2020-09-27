<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BlogListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'blogs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('title','Blog name')
                ->align('center')
                ->width('200px')
                ->render(function ($blog) {
                    return Link::make($blog->title)
                        ->route('platform.blog.edit', $blog);
                }),

            TD::set('body', 'Blog description')
                ->sort()
                ->render(function ($blog) {
                    return Link::make($blog->body)
                        ->route('platform.blog.edit', $blog);
                }),
            TD::set('created_at','Date of publication'),
        ];
    }
}
