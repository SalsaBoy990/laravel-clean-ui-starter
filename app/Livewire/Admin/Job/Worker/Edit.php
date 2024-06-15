<?php

namespace App\Livewire\Admin\Job\Worker;

use App\Trait\Clean\InteractsWithBanner;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Job\Models\Worker;

class Edit extends Component
{
    use InteractsWithBanner;
    use AuthorizesRequests;

    // used by blade / alpinejs
    public $modalId;
    public bool $isModalOpen;
    public bool $hasSmallButton;

    // inputs
    public string $name;
    public string $email;
    public string $phone;
    public Worker $worker;
    public int $workerId;

    public string $bankAccountNumber;
    public string $bankAccountName;

    protected array $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['nullable', 'email'],
        'phone' => ['nullable', 'string'],
        'bankAccountNumber' => ['nullable', 'string'],
        'bankAccountName' => ['nullable', 'string'],
    ];

    public function mount(
        string $modalId,
        Worker $worker,
        bool $hasSmallButton = false
    ) {
        $this->modalId = $modalId;
        $this->isModalOpen = false;
        $this->hasSmallButton = $hasSmallButton || false;

        $this->worker = $worker;
        $this->workerId = $this->worker->id;
        $this->name = $this->worker->name;
        $this->email = $this->worker->email ?? '';
        $this->phone = $this->worker->phone ?? '';
        $this->bankAccountNumber = $this->worker->bank_account_number ?? '';
        $this->bankAccountName = $this->worker->bank_account_name ?? '';

    }


    public function render()
    {
        return view('admin.livewire.job.worker.edit');
    }

    public function updateWorker()
    {
        $this->authorize('update', [Worker::class, $this->worker]);

        if ($this->email !== '') {
            $this->rules['email'] = 'nullable|email|unique:workers,email,'.$this->worker->id;
        }

        // validate user input
        $this->validate();

        DB::transaction(
            function () {
                $this->worker->update([
                    'name' => htmlspecialchars($this->name),
                    'email' => $this->email !== '' ? trim(htmlspecialchars($this->email)) : null,
                    'phone' => htmlspecialchars($this->phone),
                    'bank_account_number' => trim(htmlspecialchars($this->bankAccountNumber)),
                    'bank_account_name' => trim(htmlspecialchars($this->bankAccountName)),
                ]);
                $this->worker->save();
            },
            2
        );


        $this->banner(__('Successfully updated the worker ":name"!', ['name' => htmlspecialchars($this->name)]));

        return redirect()->route('worker.manage');
    }

}
