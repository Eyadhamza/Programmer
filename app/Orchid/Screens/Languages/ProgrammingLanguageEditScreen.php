<?php

namespace App\Orchid\Screens\Languages;

use App\Models\Resource;
use App\Models\ProgrammingLanguage;
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
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProgrammingLanguageEditScreen extends Screen
{

    public $name = 'Add a new Programming Language';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Here ypu can add the details of Programming Languages';
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param ProgrammingLanguage $language
     * @return array
     */
    public function query(ProgrammingLanguage $language): array
    {
        $this->exists=$language->exists;
        if ($this->exists)
        {
            $this->name='Edit Language Details';
        }
        return [
            'language'=>$language,
            'resources'=>$language->resources
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
            Button::make('Add Language')
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
                Input::make('language.name')
                    ->title('Language Name')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('language.description')
                    ->title('Language Body')
                    ->rows(5)
                    ->placeholder('Brief description for preview'),

                Input::make('language.video_url')
                    ->type('url')
                    ->placeholder('http://eyad.com')
                    ->title('Add video Url'),
//
                Picture::make('language.image')
                    ->title('add image')



            ])
            ];

    }
    public function createOrUpdate(ProgrammingLanguage $language, Request $request)
    {
        $request->validate([
            'language.name'=>'required',
            'language.description'=>'required',
            'language.url'=>'nullable',
            'language.image'=>'nullable'
        ]);
        $language->fill($request->get('language'))->save();

        Alert::info('You have successfully updated a language.');

        return redirect()->route('platform.language');
    }

    /**
     * @param ProgrammingLanguage $language
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(ProgrammingLanguage $language)
    {
        $language->delete()
            ? Alert::info('You have successfully deleted the language.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.language');
    }
    public function accessResource(ProgrammingLanguage $language,Request $request)
    {
        return redirect()->route('platform.language.resources.list',[$language]);
    }
}
