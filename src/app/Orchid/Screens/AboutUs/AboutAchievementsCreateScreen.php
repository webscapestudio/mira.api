<?php

namespace App\Orchid\Screens\AboutUs;

use App\Models\AboutAchievements;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AboutAchievementsCreateScreen extends Screen
{

   /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(AboutAchievements $about_achievement): iterable
    {
        return [
            'about_achievement' => $about_achievement,
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
            ->method('createOrUpdateAboutAchievements'),
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
                        Input::make('about_achievement.number')->required()->title('Title'),
                        Input::make('about_achievement.addition')->required()->title('Short Title'),
                        Input::make('about_achievement.description')->required()->title('Url'),
                ])->title('Сreate About Achievements'),
        ];
    }
    public function createOrUpdateAboutAchievements($about_us, Request $request)
    {
        dd($about_us);
        $about_achievement = [
            'number' => $request->about_achievement['number'],
            'addition' => $request->about_achievement['addition'],
            'description' => $request->about_achievement['description']
        ];
        $about_us = AboutUs::find('1');
        $about_us->about_achievement()->create($about_achievement)->save();
        Toast::info(__('Successfully saved'));
        return redirect()->route('platform.about-us.edit','1');
    }
     
}