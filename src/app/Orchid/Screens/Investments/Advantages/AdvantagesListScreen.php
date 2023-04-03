<?php

namespace App\Orchid\Screens\Investments\Advantages;

use App\Models\InvestAdvantages;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AdvantagesListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'invest_advantages' => InvestAdvantages::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Advantages';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Add')->icon('plus')->route('platform.invest_advantages.create')
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
            Layout::table('invest_advantages', [
                TD::make('title', 'Title'),
                TD::make('description', 'Description'),
                TD::make('created_at', 'Created')->width('160px')->render(function ($date) {
                    return $date->created_at->diffForHumans();
                }),
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (InvestAdvantages $invest_advantages) => DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.invest_advantages.edit', $invest_advantages->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $invest_advantages->id,
                                ]),
                        ])),
            ])
        ];
    }
    public function remove(Request $request): void
    {
        InvestAdvantages::findOrFail($request->get('id'))->delete();
        Toast::info(__('Successfully removed'));
    }
}
