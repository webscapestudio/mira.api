<?php

namespace App\Orchid\Screens\AboutUs;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AboutUsEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(AboutUs $about_us): iterable
    {
        return [
            'about_us' => $about_us
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string 
    {
        return 'AboutUsEditScreen';
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
        ];
    }
    public function createOrUpdate(AboutUs $about_us, Request $request)
    {
        $about_us->fill($request->get('about_us'))->save();
        return redirect()->route('platform.about-us.list');
        Toast::info(__('Manifesto was saved'));
    }
}