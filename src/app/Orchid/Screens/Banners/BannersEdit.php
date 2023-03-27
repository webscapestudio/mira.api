<?php

namespace App\Orchid\Screens\Banners;

use App\Models\Banners;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BannersEdit extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Banners $banner): iterable
    {
        return [
            'banner' => $banner
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Banner';
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
                Input::make('title_first')->title('Title first')->type('text')->required(),
                Input::make('title_second')->title('Title second')->type('text')->required(),
                Picture::make('image_desc')->title('Image (desktop)')->required()->acceptedFiles('image/*,application/pdf,.psd'),
                Picture::make('image_mob')->title('Image (mobile)')->required()->acceptedFiles('image/*,application/pdf,.psd'),
                // Select::make('project_id')
                //     ->options([
                //         'index'   => 'Index',
                //         'noindex' => 'No index',
                //     ])
                //     ->title('Project')


            ])
        ];
    }

    public function save(Request $request, Banners $banner)
    {
        $banner->fill($request->all())->save();
        $banner->save();
        Toast::info(__('Banner was saved'));
        return redirect()->route('platform.banners.list');
    }
}
