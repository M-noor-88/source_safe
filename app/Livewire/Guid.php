<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Group;
use App\Services\GroupService;
use Illuminate\Support\Facades\Auth;
class Guid extends Component
{

    public $modalFormVisible = false;
    public $groupName = '';

    public $allGroups = [];
    public $userGroups = [];

    private GroupService $groupService;
    public function boot(GroupService $groupService) {
        $this->groupService = $groupService;
        $this->loadGroups();
    }

    public function loadGroups()
    {
        $this->allGroups = $this->groupService->getAllGroups(); 
        $this->userGroups = $this->groupService->getAllGroupsByUser(Auth::id()); 
    }

    public function showCreateModal()
    {
        $this->modalFormVisible = true;
    }

    public function closeCreateModal()
    {
        $this->modalFormVisible = false;
        $this->resetForm();
    }

    public function createGroup()
    {
        $this->validate([
            'groupName' => 'required|string|max:255',
        ]);

        $data['name'] = $this->groupName;
        try {
            $this->groupService->createGroup($data);
            $this->closeCreateModal();
            session()->flash('message', 'Group created successfully.');
            $this->loadGroups(); 
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create group: ' . $e->getMessage());
        }
    }

    public function deleteGroup(int $id)
    {
        try {
            $this->groupService->deleteGroup($id);
            session()->flash('message', 'Group deleted successfully.');
            $this->loadGroups(); // Refresh the list of groups
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function showGroup(int $id)
    {
        try {
            $this->groupService->getGroupById($id);
            session()->flash('message', 'Group deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->groupName = '';
    }

    public function render()
    {
        return view('livewire.guid', [
            'allGroups' => $this->allGroups,
            'userGroups' => $this->userGroups,
        ]);
    }
}
