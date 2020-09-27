<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProgrammingLanguageListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'languages';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('name','Language name')
                ->align('center')
                ->width('200px')
                ->render(function ($language) {
                    return Link::make($language->name)
                        ->route('platform.language.edit', $language);
                }),

            TD::set('description', 'Language description')
                ->sort()
                ->render(function ($language) {
                    return Link::make($language->description)
                        ->route('platform.language.edit', $language);
                }),
            TD::set('created_at','Date of publication'),
        ];
    }
}
