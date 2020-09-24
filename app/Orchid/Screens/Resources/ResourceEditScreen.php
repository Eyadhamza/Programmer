<?php

namespace App\Orchid\Screens\Resources;

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

class ResourceEditScreen extends Screen
{

    public $name = 'Creating a new resource';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Creating a new Resource';
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
    public function query(Track $track,Resource $resource): array
    {
        $this->exists=$resource->exists;
        if ($this->exists)
        {
            $this->name='Edit Resource';
        }
        return [
            'resource'=>$resource,
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
            Button::make('Create Resource')
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
                Input::make('resource.name')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('resource.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Input::make('resource.level')->type('text')->title('What level ?'),
//


            ])
            ];

    }
    public function createOrUpdate(Track $track,Resource $resource, Request $request)
    {

       $track->resources()->create($request->get('resource'))->save();

        Alert::info('You have successfully created an resource.');

        return redirect()->route('platform.track.resources.list',[$track,$resource->resourceable]);
    }

    /**
     * @param Resource $resource
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Track $track,Resource $resource)
    {
        $resource->delete()
            ? Alert::info('You have successfully deleted the resource.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.track.resources.list',[$track]);
    }

}
