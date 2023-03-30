<?php

namespace App\Orchid\Screens\Contacts;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContactsEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Contacts $contact): iterable
    {
        return [
            'contact' => $contact
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null 
     */
    public function name(): ?string
    {
        return 'ContactsEditScreen';
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
                Input::make('contact.address')->title('Address')->type('text')->required(),
                Input::make('contact.email')->title('Email')->type('text')->required(),
                Input::make('contact.phone')->title('Phone')->type('text')->required(),
            ]),
        ];
    }
    public function createOrUpdate(Contacts $contact, Request $request)
    {
        $contact->fill($request->get('contact'))->save();
        return redirect()->route('platform.contacts.list');
        Toast::info(__('Contact was saved'));
    }
}
