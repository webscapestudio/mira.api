<?php

namespace App\Orchid\Screens\History;

use App\Models\History;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class HistoryListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'history' => History::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'History';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [Link::make('Add')->icon('plus')->route('platform.history.create')];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('history', [
                TD::make('image_desc', 'Image')->width('100')
                    ->render(function ($banner) {
                        return "<img  class='mw-100 d-block img-fluid rounded-1 w-100' src='$banner->image_desc' />";
                    }),
                TD::make('title', 'Title')->width('180px'),
                TD::make('description', 'Description')->width('grow'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (History $item) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.banners.edit', $item->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('delete', [
                                    'id' => $item->id,
                                ]),
                        ])),
            ])
        ];
    }

    public function delete(History $item): void
    {
        $item = History::find($item->id);
        $item->delete();
        Toast::info('Successfully deleted');
    }
}