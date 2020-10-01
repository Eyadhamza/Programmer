<?php

namespace App\Orchid\Screens\Tracks;

use App\Models\Resource;
use App\Models\Track;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
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

class TrackEditScreen extends Screen
{

    public $name = 'Creating a new Track';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Creating a new Track';
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Track $track
     * @return array
     */
    public function query(Track $track): array
    {
        $this->exists=$track->exists;
        if ($this->exists)
        {
            $this->name='Edit Track';
        }
        return [
            'track'=>$track,
            'resources'=>$track->resources
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
            Button::make('Add new Track')
                ->icon('icon-pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('icon-note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('icon-trash')
                ->method('remove')
                ->canSee($this->exists),
            Button::make('Access Resources')
                ->icon('icon-trash')
                ->method('accessResource')
                ->canSee($this->exists),

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
            Layout::rows([
                Input::make('track.name')
                    ->title('Write the Track name')
                    ->required()
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('track.description')
                    ->title('Write your Track Description')
                    ->required()
                    ->rows(6)
                    ->placeholder('Brief description for preview'),

                Input::make('track.video_url')
                    ->type('url')
                    ->title('Add video Url')
                    ->placeholder('http://google.com'),
//
                Cropper::make('track.image')
                    ->width(500)
                    ->height(300),


            ])
            ];

    }
    public function createOrUpdate(Track $track, Request $request)
    {
        $request->validate([
            'track.name'=>'required',
            'track.description'=>'required',
            'track.url'=>'nullable',
            'track.image'=>'nullable'
        ]);
        $track->fill($request->get('track'))->save();

        Alert::info('You have successfully updated a track.');

        return redirect()->route('platform.track');
    }

    /**
     * @param Track $track
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Track $track)
    {
        $track->delete()
            ? Alert::info('You have successfully deleted the track.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.track');
    }
    public function accessResource(Track $track,Request $request)
    {
        return redirect()->route('platform.track.resources.list',[$track]);
    }
}
