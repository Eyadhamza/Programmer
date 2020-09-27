<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SectionListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'sections';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('name','Section name')
                ->align('center')
                ->width('200px')
                ->render(function ($section) {
                    return Link::make($section->name)
                        ->route('platform.section.edit', $section);
                }),

            TD::set('description', 'Section description')
                ->sort()
                ->align('center')
                ->render(function ($section) {
                    return Link::make($section->description)
                        ->route('platform.section.edit', $section);
                }),
            TD::set('created_at','Date of publication'),
        ];
    }
}
