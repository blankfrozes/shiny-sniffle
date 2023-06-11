<?php

namespace App\Http\Livewire\Admin\Pages\Tournament;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tournament;

class TournamentTable extends DataTableComponent
{
    protected $model = Tournament::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshKeepAlive();
        $this->setSearchStatus(false);
        $this->getPerPageDisplayedItemCount();
        $this->setColumnSelectStatus(false);
        $this->setDefaultSort('id', 'desc');
    }

    protected $index = 0;

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            Column::make("#")->label(fn () => ++$this->index),
            Column::make("Username", "username")
                ->sortable(),
            Column::make("Amount", "amount")
                ->format(
                    fn($value) => 'Rp ' . number_format($value, 0, ',', '.')
                )->html(),
        ];
    }
}