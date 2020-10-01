<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LanguageResourceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'resources';

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
                ->render(function ($resource) {
                    return Link::make($resource->name)
                        ->route('platform.language.resources.edit',[$resource->resourceable_id,$resource]);
                }),

            TD::set('description', 'Resource description')
                ->sort()
                ->render(function ($resource) {
                    return Link::make($resource->description)
                        ->route('platform.language.resources.edit', [$resource->resourceable_id,$resource]);
                }),
            TD::set('created_at','Date of publication'),
        ];
    }
}
