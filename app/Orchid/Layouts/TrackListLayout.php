<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TrackListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tracks';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::set('name','Track name')
                ->align('center')
                ->width('200px')
                ->render(function ($track) {
                    return Link::make($track->name)
                        ->route('platform.track.edit', $track);
                }),

            TD::set('description', 'Track description')
                ->sort()
                ->render(function ($track) {
                    return Link::make($track->description)
                        ->route('platform.track.edit', $track);
                }),
            TD::set('created_at','Date of publication'),
        ];
    }
}
