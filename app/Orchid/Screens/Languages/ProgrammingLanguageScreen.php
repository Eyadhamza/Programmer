<?php

namespace App\Orchid\Screens\Languages;

use App\Models\ProgrammingLanguage;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use App\Orchid\Layouts\ProgrammingLanguageListLayout;
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

class ProgrammingLanguageScreen extends Screen
{

    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Programming Languages';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Here you can add info about programming languages';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'languages'=>ProgrammingLanguage::paginate()
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


            Link::make('Add Language')
                ->route('platform.language.edit')
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
            ProgrammingLanguageListLayout::class
        ];

    }


}
