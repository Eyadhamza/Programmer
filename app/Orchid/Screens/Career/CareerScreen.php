<?php

namespace App\Orchid\Screens\Career;

use App\Models\Career;
use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\MetricsExample;
use App\Orchid\Layouts\ProgrammingLanguageListLayout;
use App\Orchid\Layouts\CareerListLayout;
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

class CareerScreen extends Screen
{

    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Career screen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Sample career screen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'careers'=>Career::paginate()
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


            Link::make('Create Career')
                ->route('platform.career.edit')
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
            CareerListLayout::class
        ];

    }


}
