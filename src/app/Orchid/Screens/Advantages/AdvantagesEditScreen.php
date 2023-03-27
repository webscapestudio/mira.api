<?php

namespace App\Orchid\Screens\Advantages;

use App\Models\Advantages;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AdvantagesEditScreen extends Screen
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
        return 'Advantages';
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
                Input::make('number')->title('Number')->type('text')->required()->placeholder(),
                Input::make('addition')->title('Number text')->type('text')->required(),
                Input::make('description')->title('Description')->type('text')->required(),
            ]),
        ];
    }
    public function save(Request $request, Advantages $item)
    {
        $request->validate([
            'number' => [
                'required',
                'integer'
            ],
        ]);
        $item->fill($request->all())->save();
        $item->save();
        return redirect()->route('platform.advantages.list');
        Toast::info(__('Banner was saved'));
    }
}
