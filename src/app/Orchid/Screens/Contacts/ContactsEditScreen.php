<?php

namespace App\Orchid\Screens\Contacts;

use App\Models\Contacts;
use App\Models\Social;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
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
    public function query(Contacts $contact, Social $social): iterable
    {
        return [
            'contact' => $contact,
            'social' => $social,
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
            ModalToggle::make(__('Add new Social Media'))
            ->icon('check')
            ->modal('createSocial'),
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
                Relation::make('contact.social_id')
                ->fromModel(Social::class, 'title')
                ->multiple()
                ->title('Select Social Networks')
            ]),
            Layout::modal('createSocial', 
                Layout::rows([
                        Input::make('social.title')->required()->title('Title'),
                        Input::make('social.short_title')->required()->title('Short Title'),
                        Input::make('social.url')->required()->title('Url'),
                ]))->title('Сreate Social')->method('createOrUpdateSocial'),
        ];
    }
    public function createOrUpdate(Contacts $contact, Request $request)
    {        $contact->service()->syncWithoutDetaching(
        $request->input('partner.social_id', [])
    );
        $contact->fill($request->get('contact'))->save();
        return redirect()->route('platform.contacts.list');
        Toast::info(__('Contact was saved'));
    }
    public function createOrUpdateSocial(Social $social, Request $request)
    {
        dd($request->get('social'));
        $social->fill($request->get('social'))->save();
        Toast::info(__('Contact was saved'));
    }
        
}
