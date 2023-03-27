<?php

namespace App\Orchid\Screens\Manifesto;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Columns;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ManifestoMainScreenn extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Manifesto';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            Layout::rows([
                Input::make('title')->title('Title')->type('text')->required(),
                TextArea::make('description')->title('Description')->type('text')->required(),
                Input::make('image_desc_title')->title('Desktop image title')->type('text')->required(),
                Picture::make('image_desc')->title('Image desktop')->acceptedFiles('image/*,application/pdf,.psd')->required(),
                Input::make('image_mob_title')->title('Desktop image title')->type('text')->required(),
                Picture::make('image_mob')->title('Image mobile')->acceptedFiles('image/*,application/pdf,.psd')->required(),
            ]),
        ];
    }
}
