<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use App\Services\GroupService;
class GroupDetails extends Component
{
    public $groupId;
    public $group;

    private GroupService $groupService;
    public function boot(GroupService $groupService)
    {
        $this->groupService = $groupService;
        $this->loadGroup();
    }

    public function loadGroup()
    {
        $this->group = $this->groupService->getGroupById($this->groupId);
        if (!$this->group) {
            abort(404); // Handle group not found
        }
    }

    public function render()
    {
        return view('livewire.groups.group-details' , ['group'=> $this->group])->layout('layouts.app');
    }
}
