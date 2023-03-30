<?php

namespace App\Orchid\Screens\Achievements;

use App\Models\Achievements;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class AchievementsEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Achievements $achievement): iterable
    {
        return [
            'achievement' => $achievement
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Achievements';
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
                Input::make('achievement.number')->title('Number')->type('number')->required(),
                Input::make('achievement.addition')->title('Number text')->type('text')->required(),
                Input::make('achievement.description')->title('Description')->type('text')->required(),
            ]),
        ];
    }
    public function save(Request $request, Achievements $achievement)
    {
        $achievement->fill($request->achievement)->save();
        $achievement->save();
        return redirect()->route('platform.achievements.list');
        Toast::info(__('Achievement was saved'));
    }
}
