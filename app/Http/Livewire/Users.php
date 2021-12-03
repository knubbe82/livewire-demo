<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public ?User $user;
    public bool $showForm = false;
    public bool $updateMode = false;
    public string $name = '';
    public string $email = '';
    public string $search = '';
    public string $orderBy = 'desc';

    protected array $rules = [
        'name' => ['required', 'string', 'min:3'],
        'email' => ['required', 'email'],
    ];

    public function render()
    {
        return view('livewire.users', [
            'users' => User::where('name', 'like', '%'.$this->search.'%')->orderBy('id', $this->orderBy)->paginate(10),
        ]);
    }

    public function store()
    {
        $attributes = $this->validate();
        $user = User::create($attributes);

        $this->showForm = false;
        $this->resetFields();
        $this->emit('handleCount');
        session()->flash('message', $user->name . ' created');
    }

    public function edit(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->showForm = true;
        $this->updateMode = true;
        $this->user = $user;
    }

    public function update()
    {
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->showForm = false;
        $this->resetFields();
        session()->flash('message', $this->user->name . ' updated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function delete(User $user)
    {
        $user->delete();
        $this->emit('handleCount');
        session()->flash('message', $user->name . ' deleted');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->email = '';
    }
}
