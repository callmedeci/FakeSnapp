<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    public static function getGloballySearchableAttributes(): array
    {
        return ['first_name', 'last_name', 'mobile'];
    }
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->first_name . $record->last_name;
    }

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(4)
                    ->icon('heroicon-o-user-plus')
                    ->heading('Customer Information')
                    ->description('Fill out the Form')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->string()
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('last_name')
                        ->string()
                        ->autocomplete()
                        ->columnSpan(2)
                        ->required(),

                    Forms\Components\TextInput::make('mobile')
                        ->string()
                        ->tel()
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('customer_code')
                        ->numeric()
                        ->password()
                        ->revealable()
                        ->columnSpan(2)
                        ->nullable()
                        ->autocomplete(false),

                    Forms\Components\Textarea::make('origin')
                        ->string()
                        ->minLength(12)
                        ->maxLength(255)
                        ->columnSpan(4)
                        ->autocomplete()
                        ->autosize()
                        ->required(),

                    Forms\Components\Textarea::make('destination')
                        ->string()
                        ->minLength(12)
                        ->maxLength(255)
                        ->columnSpan(4)
                        ->autosize()
                        ->autocomplete()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('mobile')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_code')
                    ->sortable()
                    ->default('Don\'t have Code')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
