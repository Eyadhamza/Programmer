<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CareerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'careers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('title','Career name')
                ->align('center')
                ->width('200px')
                ->render(function ($career) {
                    return Link::make($career->title)
                        ->route('platform.career.edit', $career);
                }),

            TD::set('body', 'Career description')
                ->sort()
                ->render(function ($career) {
                    return Link::make($career->body)
                        ->route('platform.career.edit', $career);
                }),
            TD::set('created_at','Date of publication'),
        ];
    }
}
