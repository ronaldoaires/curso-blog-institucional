<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // List only root categories; subcategories are managed in the edit modal.
            ->modifyQueryUsing(fn(Builder $query): Builder => $query->whereNull('parent_id'))
            ->columns([
                TextColumn::make('name')
                    ->label('Título')
                    ->description(fn(Category $record): ?string => filled($record->description)
                        ? Str::limit($record->description, 80)
                        : null)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('posts_count')
                    ->label('Posts')
                    ->counts('posts')
                    ->badge()
                    ->color('info')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('children_count')
                    ->label('Subcategorias')
                    ->counts('children')
                    ->badge()
                    ->color('gray')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('views')
                    ->label('Visualizações')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),

                // Clicking the icon toggles the status.
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->alignCenter()
                    ->tooltip(fn(Category $record): string => ($record->is_active ? 'Desativar ' : 'Ativar ') . $record->name)
                    ->action(function (Category $record): void {
                        $record->update(['is_active' => ! $record->is_active]);

                        Notification::make()
                            ->title($record->is_active ? 'Categoria ativada' : 'Categoria desativada')
                            ->success()
                            ->send();
                    }),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Todas')
                    ->trueLabel('Ativas')
                    ->falseLabel('Inativas'),
            ])
            // Sort by name by default, ascending.
            ->defaultSort('name')
            // Show 25 records per page by default.
            ->defaultPaginationPageOption(25)
            ->recordActions([
                EditAction::make()
                    ->label('Editar')
                    ->iconButton()
                    ->tooltip(fn(Category $record): string => 'Editar ' . $record->name)
                    ->modalHeading(fn(Category $record): string => 'Editar ' . $record->name)
                    ->modalSubmitActionLabel('Salvar')
                    ->modalWidth(Width::ThreeExtraLarge)
                    ->successNotificationTitle('Categoria atualizada com sucesso'),

                DeleteAction::make()
                    ->label('Deletar')
                    ->iconButton()
                    ->tooltip(fn(Category $record): string => 'Deletar ' . $record->name)
                    ->modalHeading(fn(Category $record): string => 'Deletar ' . $record->name)
                    ->modalDescription(function (Category $record): string {
                        $count = $record->children()->count();

                        return $count > 0
                            ? "Esta categoria possui {$count} subcategoria(s), que também serão deletadas. Deseja continuar?"
                            : 'Tem certeza que deseja deletar esta categoria?';
                    })
                    // Remove subcategories so they do not become root categories (parent_id nullOnDelete).
                    ->before(fn(Category $record) => $record->children()->delete())
                    ->successNotificationTitle('Categoria deletada com sucesso'),
            ])->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Deletar selecionadas')
                        ->modalHeading('Deletar categorias selecionadas')
                        ->modalDescription('As subcategorias das categorias selecionadas também serão deletadas. Deseja continuar?')
                        // Remove subcategories so they do not become root categories (parent_id nullOnDelete).
                        ->before(function (Collection $records): void {
                            Category::query()
                                ->whereIn('parent_id', $records->modelKeys())
                                ->delete();
                        })
                        ->successNotificationTitle('Categorias deletadas com sucesso'),
                ]),
            ])
            ->emptyStateHeading('Nenhuma categoria cadastrada')
            ->emptyStateDescription('Clique em "Cadastrar categoria" para começar.');
    }
}
