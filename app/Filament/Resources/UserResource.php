<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     //setting letak grup menu
    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?int $navigationSort = 3; // Urutan setelah Kategori

    // Label
    protected static ?string $modelLabel = 'Admin';
    protected static ?string $pluralModelLabel = 'Admin';

        public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->can('view users');
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->can('view users');
    }

    public static function canView(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->check() && auth()->user()->can('view users');
    }

    public static function canCreate(): bool
    {
        return auth()->check() && auth()->user()->can('create users');
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->check() && auth()->user()->can('edit users');
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth()->check() && auth()->user()->can('delete users');
    }

    public static function canDeleteAny(): bool
    {
        return auth()->check() && auth()->user()->can('delete users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->columnSpanFull(),
                TextInput::make('email')->required(),
                Select::make('roles')
                ->relationship('roles', 'name')
                ->preload()
                ->label('Roles'),
                TextInput::make('password')
                ->required()
                ->password() // Ubah menjadi input type password
                ->revealable() // Tambahkan tombol lihat/sembunyikan
                ->minLength(8) // Validasi panjang minimum
                ->confirmed() // Untuk fitur konfirmasi password
                ->rules(['nullable']) // Tidak wajib diisi saat edit
                ->dehydrated(fn ($state) => filled($state)) // Hindari hash jika kosong
                ->autocomplete('new-password') // Hindari autofill browser
                ->prefixIcon('heroicon-o-lock-closed'), // Tambahkan ikon
            
            // Field konfirmasi password (opsional tapi disarankan)
            TextInput::make('password_confirmation')
                ->requiredWith('password')
                ->password()
                ->revealable()
                ->label('Confirm Password')
                ->dehydrated(false), // Jangan simpan ke database
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('Role')
                    ->getStateUsing(fn($record) => $record->roles->pluck('name')->join(', '))
                    ->sortable(),
                            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function ($query) {
                $query->where('email', '!=', 'superadmin@filament.com');
            });
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
