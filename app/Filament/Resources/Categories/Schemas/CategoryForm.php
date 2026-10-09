<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ...self::fields(),

                // Subcategories can only be enabled when editing a root category.
                Toggle::make('has_subcategories')
                    ->label('Habilitar subcategorias')
                    ->helperText('Permite cadastrar subcategorias dentro desta categoria.')
                    ->live()
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Toggle $component, ?Category $record): void {
                        // Enable the toggle when the category already has subcategories.
                        $component->state($record !== null && $record->children()->exists());
                    })
                    ->visible(fn(string $operation, ?Model $record): bool => self::isRootBeingEdited($operation, $record))
                    ->columnSpanFull(),

                Repeater::make('children')
                    ->label('Subcategorias')
                    ->relationship('children', fn(Builder $query): Builder => $query->orderBy('name'))
                    ->schema(self::fields())
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                    ->addActionLabel('Adicionar subcategoria')
                    ->collapsible()
                    ->defaultItems(0)
                    ->visible(fn(Get $get, string $operation, ?Model $record): bool => self::isRootBeingEdited($operation, $record)
                        && (bool) $get('has_subcategories'))
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    /**
     * Shared fields used by both the category and the subcategory forms.
     *
     * @return array<int, \Filament\Schemas\Components\Component>
     */
    protected static function fields(): array
    {
        return [
            Grid::make(['default' => 1, 'md' => 3])
                ->schema([
                    TextInput::make('name')
                        ->label('Título')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(['default' => 1, 'md' => 2]),

                    ToggleButtons::make('is_active')
                        ->label('Status')
                        ->boolean('Ativo', 'Inativo')
                        ->inline()
                        ->default(true)
                        ->required()
                        ->columnSpan(['default' => 1, 'md' => 1]),

                    Textarea::make('description')
                        ->label('Descrição')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ];
    }

    protected static function isRootBeingEdited(string $operation, ?Model $record): bool
    {
        return $operation === 'edit'
            && $record !== null
            && blank($record->parent_id);
    }
}
