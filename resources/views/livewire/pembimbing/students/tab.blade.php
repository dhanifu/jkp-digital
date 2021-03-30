<div>
    <div class="card shadow">
        <div class="card-header bg-white border-0 shadow-sm">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a wire:click="$emit('refreshDone')" class="nav-link active" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="true">Selesai</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="missing-tab" data-toggle="tab" href="#missing" role="tab" aria-controls="missing" aria-selected="false">Belum Selesai</a>
                </li>
            </ul>
        </div>

        <div class="card-body m-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane py-3 fade show active" id="done" role="tabpanel" aria-labelledby="done-tab">
                    @livewire('pembimbing.students.done')
                </div>
                <div class="tab-pane py-3 fade" id="missing" role="tabpanel" aria-labelledby="missing-tab">
                    ...
                </div>
            </div>
        </div>
    </div>
</div>
