<?php

namespace App\Orchid\Screens\Manifesto;

use App\Models\Manifesto;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ManifestoListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'manifestos' => Manifesto::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Manifesto List Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Add')->icon('plus')->route('platform.manifestos.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('manifestos', [
                TD::make('image_desc', 'Image')->width('80px')
                    ->render(function ($manifesto) {
                        return "<img  class='mw-80 d-block img-fluid rounded-1 w-80' src='$manifesto->image_desc' />";
                    }),
                TD::make('title', 'Title')->width('180px'),
                TD::make('description', 'Description')->width('grow'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Manifesto $manifesto) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.manifestos.edit', $manifesto->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('delete', [
                                    'id' => $manifesto->id,
                                ]),
                        ])),
                        ])
        ];
    }

    public function delete(Manifesto $manifesto): void
    {
        $manifesto = Manifesto::find($manifesto->id);
        $manifesto->delete();
        Toast::info('Successfully deleted');
    }
}
