<?php

namespace App\Orchid\Screens\Achievements;

use App\Models\Achievements;
use App\Orchid\Layouts\Achievements\AchievementsListTable;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AchievementsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Achievements $achievements): iterable
    {
        return [
            'achievements' => Achievements::filters()->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Achievements list screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Сreate achievement')->modal('createAchievement')->method('create')
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
            AchievementsListTable::class,
            Layout::modal('createAchievement', Layout::rows([
                Group::make([
                    Input::make('number')->required()->title('Number'),
                    Input::make('addition')->required()->title('Addition'),
                ]),
                TextArea::make('description')->required()->title('Description'),
            ]))->title('Сreate achievement'),

            Layout::modal('editAchievement', Layout::rows([
                Input::make('achievement.id')->type('hidden'),
                Group::make([
                    Input::make('number')->required()->title('Number'),
                    Input::make('addition')->required()->title('Addition'),
                ]),
                TextArea::make('description')->required()->title('Description'),
            ]))->title('Edit achievement')->async('asyncGetAchievement'),

            Layout::modal('deleteAchievement', Layout::rows([
                Input::make('achievement.id')->type('hidden'),
            ]))->async('asyncGetAchievement')
        ];
    }
    public function asyncGetAchievement(Achievements $achievement): array
    {
        return [
            'achievement' => $achievement
        ];
    }
    public function delete(Request $request): void
    {
        $achievement = Achievements::find($request->input('achievement.id'));
        dd($request->input('achievement.id'));
        $achievement->delete();
        Toast::info('Successfully deleted');
    }

    public function update(Request $request): void
    {
        
        $achievement = Achievements::find($request->input('achievement.id'));

        $achievement->update($request->all());
        Toast::info('Successfully updated');
    }


    public function create(Request $request): void
    {
        $request->validate([
            'number' => ['required'],
            'addition' => ['required'],
            'description' => ['required']
        ]);
        $achievement = Achievements::create($request->all());
        $achievement->save();
        Toast::info('Successfully created');
    }
}
