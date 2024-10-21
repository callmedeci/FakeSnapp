<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use App\Filament\Resources\DriverResource\RelationManagers;
use App\Models\Driver;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Laravel\Prompts\search;

//class  SimpleReapeater extends Forms\Components\Repeater {
//    public function getChildComponentContainer($key = null): ComponentContainer
//    {
//        return parent::getChildComponentContainer($key)
//            ->extraAttributes(['class' => 'flex justify-center items-center']);
//    }
//
//    public function isSimple(): bool
//    {
//        return true;
//    }
//}
class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    public static function getGloballySearchableAttributes(): array
    {
        return ['first_name', 'last_name', 'age', 'mobile', 'car', 'gender', 'score'];
    }
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->first_name . $record->last_name;
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Age' => $record->age,
            'Car' => $record->car,
            'Score' => $record->score,
            'Gender' => $record->gender === 1 ? 'Men' : 'Female',
        ];
    }

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Section::make()
                   ->columns(3)
                   ->icon('heroicon-o-user-plus')
                   ->heading('Customer Information')
                   ->description('Fill out the Form')
                   ->schema([
                    Forms\Components\FileUpload::make('profile')
                    ->avatar()
                    ->alignCenter()
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->circleCropper()
                    ->columnSpan(4),

                    Forms\Components\TextInput::make('first_name')
                        ->string()
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('last_name')
                        ->string()
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('mobile')
                        ->string()
                        ->tel()
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('car')
                        ->string()
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('score')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(100)
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\TextInput::make('driver_code')
                        ->numeric()
                        ->password()
                        ->revealable()
                        ->columnSpan(2)
                        ->nullable()
                        ->autocomplete(false),

                    Forms\Components\TextInput::make('age')
                        ->numeric()
                        ->minValue(18)
                        ->maxValue(45)
                        ->columnSpan(2)
                        ->autocomplete()
                        ->required(),

                    Forms\Components\Toggle::make('gender')
                        ->required()
                        ->label('is Male ?')
                        ->columnSpanFull()
                        ->onIcon('heroicon-s-check-circle')
                        ->offIcon('heroicon-c-minus-circle')
                        ->offColor('danger')
                        ->onColor('primary')
                        ->inline(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile')
                    ->searchable()
                    ->circular()
                    ->sortable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('gender')
                    ->alignCenter()
                    ->label('Is Male?')
                    ->searchable()
                    ->sortable()
                    ->boolean(),
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
            'index' => Pages\ListDrivers::route('/'),
            'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }
}
