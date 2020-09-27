<?php

namespace App\Orchid;

use Laravel\Scout\Searchable;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [

            ItemMenu::label('Sections')
                ->icon('layers')
                ->title('Navigation')
                ->slug('sections')
                ->childs(),
            ItemMenu::label('Sections list')
                ->route('platform.section')
                ->place('sections'),
            ItemMenu::label('Add Section')
                ->route('platform.section.edit')
                ->place('sections'),

            ItemMenu::label('Tracks')
                ->icon('monitor')
                ->route('platform.track')
                ->slug('tracks')
                ->childs(),
            ItemMenu::label('Tracks list')
                ->route('platform.track')
                ->place('tracks'),
            ItemMenu::label('Add Track')
                ->route('platform.track.edit')
                ->place('tracks'),



            ItemMenu::label('Languages')
                ->icon('bag')
                ->route('platform.language')
                ->slug('languages')
                ->childs(),
            ItemMenu::label('Languages list')
                ->route('platform.language')
                ->place('languages'),

            ItemMenu::label('Add Language')
                ->route('platform.language.edit')
                ->place('languages'),

            ItemMenu::label('Career Development')
                ->icon('dollar')
                ->slug('career-development')
                ->childs(),
            ItemMenu::label('List Career Tips')
                ->route('platform.career')
                ->icon('careers')
                ->place('career-development'),
            ItemMenu::label('Add Career Tip')
                ->route('platform.career.edit')
                ->icon('careers')
                ->place('career-development'),

            ItemMenu::label('Blog Management')
                ->icon('book-open')
                ->slug('blog-management')
                ->childs(),
            ItemMenu::label('Manage Blog')
                ->route('platform.blog')
                ->place('blog-management'),
            ItemMenu::label('Add New Article')
                ->route('platform.blog.edit')
                ->place('blog-management'),

        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Access rights'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            ItemMenu::label(__('Users'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('All registered users')),

            ItemMenu::label(__('Roles'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('A Role defines a set of tasks a user assigned the role is allowed to perform. ')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Systems'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return Searchable|string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
