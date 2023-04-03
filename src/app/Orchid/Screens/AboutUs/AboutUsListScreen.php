<?php

namespace App\Orchid\Screens\AboutUs;

use App\Models\AboutUs;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AboutUsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'about_us' => AboutUs::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'About Us';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Add')->icon('plus')->route('platform.about-us.create')
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
            Layout::table('about_us', [
                TD::make('image_desc', 'Image')->width('80px')
                    ->render(function ($about_us) {
                        return "<img  class='mw-80 d-block img-fluid rounded-1 w-80' src='$about_us->image_desc' />";
                    }),
                TD::make('title', 'Title')->width('180px'),
                TD::make('description', 'Description')->width('grow'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (AboutUs $about_us) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.about-us.edit', $about_us->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('delete', [
                                    'id' => $about_us->id,
                                ]),
                        ])),
                        ])
        ];
    }

    public function delete(AboutUs $about_us): void
    {
        $about_us = AboutUs::find($about_us->id);
        $about_us->delete();
        Toast::info('Successfully deleted');
    }
}
