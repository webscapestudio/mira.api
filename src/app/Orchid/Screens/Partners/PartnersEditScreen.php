<?php

namespace App\Orchid\Screens\Partners;

use App\Models\Partners;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PartnersEditScreen extends Screen
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
        return 'Partners';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [Button::make(__('Save'))
            ->icon('check')
            ->method('save'),];
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
                Input::make('title')
                    ->title('Title')
                    ->type('text')
                    ->required()
                    ->placeholder(),
                TextArea::make('description')->title('Description')->required(),
                Picture::make('logo')->title('Logo')->required()->acceptedFiles('image/*,application/pdf,.psd'),
            ])
        ];
    }

    public function save(Request $request, Partners $item)
    {
        $item->fill($request->all())->save();
        $item->save();
        Toast::info(__('Partners was saved'));
        return redirect()->route('platform.partners.list');
    }
}
