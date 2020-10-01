<?php

namespace App\Orchid\Screens\TrackResources;

use App\Models\Resource;


use App\Models\Track;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use App\Orchid\Layouts\LanguageResourceListLayout;
use App\Orchid\Layouts\ResourceListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TrackResourceListScreen extends Screen
{

    public $name = 'All resources';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Resources';
    /**
     * @var bool
     */
    public $exists = false;


    /**
     * Query data.
     *
     * @param Resource $resource
     * @return array
     */
    public function query(Track $track): array
    {

        return [
            'resources'=>$track->resources()->paginate(),

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
            Button::make('Add Resource')
                ->method('addResource')
            // 4 needs to
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
            ResourceListLayout::class
        ];

    }
    public function addResource(Track $track)
    {
        return redirect()->route('platform.track.resources.edit',[$track]);
    }


}
