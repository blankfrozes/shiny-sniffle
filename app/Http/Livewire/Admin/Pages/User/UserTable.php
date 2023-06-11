<?php

namespace App\Http\Livewire\Admin\Pages\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshKeepAlive();
        $this->setSearchStatus(false);
        $this->getPerPageDisplayedItemCount();
        $this->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'View ' . $row->name)
                ->location(fn($row) => route('user', $row)),
            Column::make('Edit')
                ->label(
                fn($row) => <<<EOT
                <div class="flex flex-col items-start space-y-2">
                    <button
                        class="px-4 py-2 text-sm text-white bg-blue-700 rounded hover:bg-blue-500"
                        x-data
                        x-on:click="\$dispatch('open-edit-dialog', $row->id)"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <button
                        class="px-4 py-2 text-sm text-white bg-red-700 rounded hover:bg-red-500"
                        x-data
                        x-on:click="\$dispatch('open-delete-dialog', $row->id)"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
EOT)->html(),
        ];
    }
}