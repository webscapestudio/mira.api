<?php

namespace App\Orchid\Screens\Banners;

use App\Models\Banners;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BannersList extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */ 
    public function query(): iterable
    {
        return ['banners' => Banners::all()];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Banners';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Add banner')->icon('plus')->route('platform.banners.create')
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
            Layout::table('banners', [
                TD::make('image_desc', 'Banner')->width('100')
                    ->render(function ($banner) {
                        return "<img  class='mw-100 d-block img-fluid rounded-1 w-100' src='$banner->image_desc' />";
                    }),
                TD::make('title_first', 'Title first'),
                TD::make('title_second', 'Title second'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Banners $banner) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.banners.edit', $banner->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $banner->id,
                                ]),
                        ])),
            ])
        ];
    }
    public function remove(Request $request): void
    {
        Banners::findOrFail($request->get('id'))->delete();
        Toast::info(__('Successfully removed'));
    }
}
