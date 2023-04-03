<?php

namespace App\Orchid\Screens\AboutUs;

use App\Models\AboutAchievements;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AboutUsEditScreen extends Screen
{
        /**
     * @var AboutUs
     */
    public $about_us;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(AboutUs $about_us): iterable
    {
        return [
            'about_us' => $about_us,
            'about_achievements' => AboutAchievements::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string 
    {
        return 'AboutUs';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add new Achievement'))
            ->icon('check')
            ->route('platform.about_achievements.create', $this->about_us->id), // ??????????????
            Button::make(__('Save'))
            ->icon('check')
            ->method('createOrUpdate'),
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
                Input::make('about_us.title')->title('Title')->type('text')->required(),
                TextArea::make('about_us.description')->title('Description')->type('text')->required(),
                Select::make('about_us.text_size')
                ->options([
                    'big'   => 'Big',
                    'small' => 'Small',
                ])->title('Text size')->required(),
                Picture::make('about_us.image_desc')->title('Image desktop')->acceptedFiles('image/*,application/pdf,.psd')->required(),
                Picture::make('about_us.image_mob')->title('Image mobile')->acceptedFiles('image/*,application/pdf,.psd')->required(),
            ]),
            Layout::table('about_achievements', [
                TD::make('number', 'Number')->width('180px'),
                TD::make('addition', 'Addition')->width('grow'),
                TD::make('description', 'Description')->width('grow'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (AboutAchievements $about_achievements) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('deleteSocial', [
                                    'id' => $about_achievements->id,
                                ]),
                        ])),
                    ]),
        ];
    }
    public function deleteSocial(AboutAchievements $about_achievements): void
    {
        $about_achievements = AboutAchievements::find($about_achievements->id);
        $about_achievements->delete();
        Toast::info('Successfully deleted');
    }
    public function createOrUpdate(AboutUs $about_us, Request $request)
    {
        $about_us->fill($request->get('about_us'))->save();
        return redirect()->route('platform.about-us.list');
        Toast::info(__('Successfully saved'));
    }
}