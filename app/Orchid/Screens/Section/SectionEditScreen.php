<?php

namespace App\Orchid\Screens\Section;

use App\Models\Section;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SectionEditScreen extends Screen
{

    public $name = 'Add a new Section';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Here is where you can add a new Section';
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Section $section
     * @return array
     */
    public function query(Section $section): array
    {
        $this->exists=$section->exists;
        if ($this->exists)
        {
            $this->name='Edit Section';
        }
        return [
            'section'=>$section
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
            Button::make('Add Section')
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
                Input::make('section.name')
                    ->title('Section Name :')
                    ->placeholder('My greatest Section')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('section.description')
                    ->title('Section Description :')
                    ->rows(5)
                    ->placeholder('Brief description for preview'),

                Picture::make('section.image')
                    ->title('Add an image to your section :')


            ])
            ];

    }
    public function createOrUpdate(Section $section, Request $request)
    {
        $request->validate([
            'section.name'=>'required',
            'section.description'=>'required',
            'section.image'=>'nullable'
        ]);
        $section->fill($request->get('section'))->save();

        Alert::info('You have successfully created an section.');

        return redirect()->route('platform.section');
    }

    /**
     * @param Section $section
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Section $section)
    {
        $section->delete()
            ? Alert::info('You have successfully deleted the section.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.section');
    }

}
