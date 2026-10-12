<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

/**
 * Settings are key/value rows, so a CRUD table would be the wrong shape.
 * This renders one form grouped by section and writes every key at once.
 */
class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Site settings';

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::pluck('value', 'key')->all());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contact')->columns(2)->schema(
                    $this->fieldsFor('contact')
                ),
                Section::make('Social links')->columns(2)->schema(
                    $this->fieldsFor('social')
                ),
                Section::make('General')->columns(2)->schema(
                    $this->fieldsFor('general')
                ),
            ])
            ->statePath('data');
    }

    /** Build inputs from the rows themselves, so a new setting needs no code. */
    protected function fieldsFor(string $group): array
    {
        return Setting::query()
            ->where('group', $group)
            ->orderBy('id')
            ->get()
            ->map(function (Setting $setting) {
                $field = $setting->type === 'textarea'
                    ? Textarea::make($setting->key)->rows(3)->columnSpanFull()
                    : TextInput::make($setting->key);

                return $field->label($setting->label);
            })
            ->all();
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
