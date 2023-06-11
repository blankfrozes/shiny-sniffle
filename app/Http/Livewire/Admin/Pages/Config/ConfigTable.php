<?php

namespace App\Http\Livewire\Admin\Pages\Config;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Config;

class ConfigTable extends DataTableComponent
{
    protected $model = Config::class;

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
            Column::make("ID", "id"),
            Column::make("Key", "key")
                ->sortable(),
            Column::make("Value", "value")
                ->sortable(),
            Column::make('Edit')
                ->label(
                fn($row) => <<<EOT
                <div class="flex flex-col items-start space-y-2">
                    <button
                        class="px-4 py-2 text-sm text-white bg-blue-700 rounded hover:bg-blue-500"
                        x-data
                        x-on:click="\$dispatch('open-edit-dialog', $row->id)"
                    >
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                </div>
EOT)->html(),
        ];
    }
}
