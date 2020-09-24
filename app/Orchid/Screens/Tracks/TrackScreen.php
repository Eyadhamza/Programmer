<?php

namespace App\Orchid\Screens\Tracks;

use App\Models\Track;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use App\Orchid\Layouts\TrackListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TrackScreen extends Screen
{

    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Track screen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Sample track screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'tracks'=>Track::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [


            Link::make('Create Track')
                ->route('platform.track.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            TrackListLayout::class
        ];

    }


}
