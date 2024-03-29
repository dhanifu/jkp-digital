<div>
    <div class="card shadow">
        <ul class="nav nav-tabs px-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a wire:click="$emit('refreshAssigned')" class="nav-link active" id="assigned-tab" data-toggle="tab" href="#assigned" role="tab" aria-controls="assigned" aria-selected="true">Assigned</a>
            </li>
            <li class="nav-item" role="presentation">
                <a wire:click="$emit('refreshMissing')" class="nav-link" id="missing-tab" data-toggle="tab" href="#missing" role="tab" aria-controls="missing" aria-selected="false">Missing</a>
            </li>
            <li class="nav-item" role="presentation">
                <a wire:click="$emit('refreshDone')" class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane px-3 py-3 fade show active" id="assigned" role="tabpanel" aria-labelledby="assigned-tab">
                <livewire:student.todo.assigned />
            </div>
            <div class="tab-pane px-3 py-3 fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                <livewire:student.todo.done />
            </div>
            <div class="tab-pane px-3 py-3 fade" id="missing" role="tabpanel" aria-labelledby="missing-tab">
                <livewire:student.todo.missing />
            </div>
        </div>
    </div>
</div>
