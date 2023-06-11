<?php

namespace App\Http\Livewire\Admin\Pages\Tournament;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tournament;
use App\Imports\WinnerImport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AddWinnerListDialog extends Component
{
    use WithFileUploads;
    public $initializing = true;
    public $fileWinner;

    protected $validationAttributes = [
        'fileWinner' => 'file winner',
    ];

    public function init()
    {
        $this->initializing = false;
    }

    public function submit()
    {
        $this->validate([
            'fileWinner' => 'required|mimes:xlsx,xls,csv',
        ], [], $this->validationAttributes);

        $fileData = null;
        if ($this->fileWinner) {
            $import = new WinnerImport();

            $fileData = Excel::toArray($import, $this->fileWinner)[0];
        }

        // DB::beginTransaction();

        try {
            Tournament::truncate();

            foreach ($fileData as $data) {
                $newRow = [
                    'username' => $data['pemain'],
                    'amount' => $data['turnover']
                ];

                Tournament::create($newRow);
            }

            // DB::commit();

        } catch (\Exception $e) {
            // DB::rollback();

            return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Something went wrong!']);
        }

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('flash', ['type' => 'success', 'message' => 'Winner List Saved successfully!']);
        $this->dispatchBrowserEvent('close-add-dialog');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.pages.tournament.add-winner-list-dialog');
    }
}