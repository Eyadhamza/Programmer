<?php

namespace App\Orchid\Screens\Career;

use App\Models\Resource;
use App\Models\Career;
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

class CareerEditScreen extends Screen
{

    public $name = 'Add a new Career tip';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Here you can modify the career section of your app and add new tips';
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Career $career
     * @return array
     */
    public function query(Career $career): array
    {
        $this->exists=$career->exists;
        if ($this->exists)
        {
            $this->name='Edit Career';
        }
        return [
            'career'=>$career,
            'resources'=>$career->resources
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
            Button::make('Create Career')
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
                Input::make('career.title')
                    ->title('Subject Title')
                    ->required()
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('career.body')
                    ->title('Subject Description')
                    ->rows(5)
                    ->required()
                    ->placeholder('Brief description for preview'),

                Input::make('career.url')
                    ->type('url')
                    ->placeholder('http://facebook.com')
                    ->title('Add Url related to article'),
//
                Cropper::make('career.image')
                    ->width(500)
                    ->height(300),


            ])
            ];

    }
    public function createOrUpdate(Career $career, Request $request)
    {
        $request->validate([
            'career.title'=>'required',
            'career.body'=>'required',
            'career.url'=>'nullable',
            'career.image'=>'nullable'
        ]);
        $career->fill($request->get('career'))->save();

        Alert::info('You have successfully updated a career.');

        return redirect()->route('platform.career');
    }

    /**
     * @param Career $career
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Career $career)
    {
        $career->delete()
            ? Alert::info('You have successfully deleted the career.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.career');
    }
    public function accessResource(Career $career,Request $request)
    {
        return redirect()->route('platform.career.resources.list',[$career]);
    }
}
