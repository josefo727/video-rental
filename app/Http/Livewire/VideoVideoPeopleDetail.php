<?php

namespace App\Http\Livewire;

use App\Models\Video;
use App\Models\People;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\VideoPerson;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VideoVideoPeopleDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Video $video;
    public VideoPerson $videoPerson;
    public $allPeopleForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New VideoPerson';

    protected $rules = [
        'videoPerson.people_id' => ['required', 'exists:people,id'],
    ];

    public function mount(Video $video): void
    {
        $this->video = $video;
        $this->allPeopleForSelect = People::pluck('name', 'id');
        $this->resetVideoPersonData();
    }

    public function resetVideoPersonData(): void
    {
        $this->videoPerson = new VideoPerson();

        $this->videoPerson->people_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newVideoPerson(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.video_video_people.new_title');
        $this->resetVideoPersonData();

        $this->showModal();
    }

    public function editVideoPerson(VideoPerson $videoPerson): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.video_video_people.edit_title');
        $this->videoPerson = $videoPerson;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->videoPerson->video_id) {
            $this->authorize('create', VideoPerson::class);

            $this->videoPerson->video_id = $this->video->id;
        } else {
            $this->authorize('update', $this->videoPerson);
        }

        $this->videoPerson->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', VideoPerson::class);

        VideoPerson::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetVideoPersonData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->video->videoPeople as $videoPerson) {
            array_push($this->selected, $videoPerson->id);
        }
    }

    public function render(): View
    {
        return view('livewire.video-video-people-detail', [
            'videoPeople' => $this->video->videoPeople()->paginate(20),
        ]);
    }
}
