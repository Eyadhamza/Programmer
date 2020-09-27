<?php


namespace App\Orchid\Layouts;


use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MainPageLayout extends Table
{
    protected $target = 'users';

    protected function columns(): array
    {
        return[
        TD::set('name','user name')
            ->align('center')
            ->width('200px')
            ->render(function () {
                dd(auth()->user());
//               return $user->name;
            })
        ];
    }
}
