<?php

namespace App\Orchid\Screens\History;

use App\Models\History;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class HistoryEditScreen extends Screen
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
        return 'History';
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
                Input::make('year')->title('Year')->type('text')->required(),
                Input::make('title')->title('Title')->type('text')->required(),
                TextArea::make('description')->title('Description')->rows(5)->type('text')->required(),
                Picture::make('image_desc')->title('Image desktop')->acceptedFiles('image/*,application/pdf,.psd')->required(),
                Picture::make('image_mob')->title('Image desktop')->acceptedFiles('image/*,application/pdf,.psd')->required(),
            ]),


        ];
    }

    public function save(Request $request, History $item)
    {
        $item->fill($request->all())->save();
        $item->save();
        Toast::info(__('History was saved'));
        return redirect()->route('platform.history.list');
    }
}
