<?php

namespace App\Orchid\Screens\Vacancies;

use App\Models\Vacancies;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class VacanciesEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Vacancies $vacancie): iterable
    {
        return [
            'vacancie' => $vacancie
        ]; 
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Vacancy Edit';
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
                Input::make('vacancie.title')->title('Title')->type('text')->required(),
                TextArea::make('vacancie.content')->title('Content')->required(),
                Picture::make('vacancie.image_desc')->title('Image')->required()->acceptedFiles('image/*,application/pdf,.psd'),
            ])
        ];
    }
    public function createOrUpdate(Vacancies $vacancie, Request $request)
    {
        $vacancie->fill($request->get('vacancie'))->save();

        Toast::info(__('Successfully saved'));
        return redirect()->route('platform.vacancies.list');
    }
}
