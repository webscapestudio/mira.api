<?php

namespace App\Orchid\Layouts\Pages;

use App\Models\Pages;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PagesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'pages';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', "Title")->width('150px')->cantHide()->canSee(true),
            TD::make('title', "URL")->render(function (Pages $page) {
                return $page->title > 5 ? 'large' : 'small';
            })->canSee(false),
            TD::make('', 'Edit')->alignRight()
        ];
    }
}
