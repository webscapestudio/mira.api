<?php

namespace App\Orchid\Screens\Contacts;

use App\Models\Contacts;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContactsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'contacts' => Contacts::all()
        ]; 
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Contacts List Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Add')->icon('plus')->route('platform.contacts.create')
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
            Layout::table('contacts', [
                TD::make('address', 'Address')->width('180px'),
                TD::make('email', 'Email')->width('grow'),
                TD::make('phone', 'Phone')->width('grow'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Contacts $contacts) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.contacts.edit', $contacts->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('delete', [
                                    'id' => $contacts->id,
                                ]),
                        ])),
                        ])
        ];
    }

    public function delete(Contacts $contacts): void
    {
        $contacts = Contacts::find($contacts->id);
        $contacts->delete();
        Toast::info('Successfully deleted');
    }
}
