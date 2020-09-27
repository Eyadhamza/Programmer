<?php

namespace App\Orchid\Screens\Blog;

use App\Models\Resource;
use App\Models\Blog;
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

class BlogEditScreen extends Screen
{

    public $name = 'Add a new Article';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Here you can modify the blog and add articles';
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Blog $blog
     * @return array
     */
    public function query(Blog $blog): array
    {
        $this->exists=$blog->exists;
        if ($this->exists)
        {
            $this->name='Edit Blog';
        }
        return [
            'blog'=>$blog,
            'resources'=>$blog->resources
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
            Button::make('Add Article')
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
                Input::make('blog.title')
                    ->title('Article title')
                    ->placeholder('Attractive but mysterious title')
                    ->help('Specify a short descriptive title for this post.'),

                TextArea::make('blog.body')
                    ->title('Article Body')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Input::make('blog.address_url')
                    ->type('url')
                    ->placeholder('http://morshedy.com')
                    ->title('Add Article Url'),
//
                Cropper::make('blog.image')
                    ->width(500)
                    ->title('Add an Image to your Article')
                    ->height(300),


            ])
            ];

    }
    public function createOrUpdate(Blog $blog, Request $request)
    {
        $request->validate([
            'blog.title'=>'required',
            'blog.body'=>'required',
            'blog.url'=>'nullable',
            'blog.image'=>'nullable'
        ]);
        $blog->fill($request->get('blog'))->save();

        Alert::info('You have successfully updated a blog.');

        return redirect()->route('platform.blog');
    }

    /**
     * @param Blog $blog
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Blog $blog)
    {
        $blog->delete()
            ? Alert::info('You have successfully deleted the blog.')
            : Alert::warning('An error has occurred')
        ;

        return redirect()->route('platform.blog');
    }
    public function accessResource(Blog $blog,Request $request)
    {
        return redirect()->route('platform.blog.resources.list',[$blog]);
    }
}
