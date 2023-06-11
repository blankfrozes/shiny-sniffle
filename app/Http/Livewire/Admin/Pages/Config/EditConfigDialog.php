<?php

namespace App\Http\Livewire\Admin\Pages\Config;

use Livewire\Component;
use App\Models\Config;
use App\Models\Constants\ConfigKey;

class EditConfigDialog extends Component
{
    public bool $initializing = true;

    public array $config = [];

    public string $name = "";

    protected array $rules = [
        'config.value' => 'required',
    ];

    protected array $validationAttributes = [
        'config.value' => 'value',
    ];

    public function init($id)
    {
        $config = Config::find($id);
        $this->config = $config->toArray();
        $this->name = ConfigKey::humanize($config->key);

        $this->initializing = false;
    }

    public function submit()
    {
        $this->validate($this->rules, [], $this->validationAttributes);

        try {
            Config::findOrFail($this->config['id'])->update([
                'value' => $this->config['value'],
            ]);
        } catch (\Exception $e) {
            return $this->dispatchBrowserEvent('flash', ['type' => 'error', 'message' => 'Terjadi Kesalahan Mohon Ulangi Kembali!']);
        }

        $this->emit('refreshLivewireDatatable');
        $this->dispatchBrowserEvent('flash', ['type' => 'success', 'message' => 'Config berhasil diubah!']);
        $this->dispatchBrowserEvent('close-edit-dialog');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.admin.pages.config.edit-config-dialog');
    }
}