<div>
    <div class="card shadow">
        <div class="card-header bg-white border-0 shadow-sm">
            <div class="row">
                <div class="col-md-10">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a wire:click="$emit('refreshDone')" class="nav-link active" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="true">Selesai</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a wire:click="$emit('refreshMissing')" class="nav-link" id="missing-tab" data-toggle="tab" href="#missing" role="tab" aria-controls="missing" aria-selected="false">Belum Selesai</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-secondary rounded-0 shadow-sm" id="servicesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Export
                            <i class="fas fa-caret-down ml-2"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right p-0 pt-2" aria-labelledby="servicesDropdown"
                            style="width: 200px">

                            <label class="dropdown-header">Minggu Ke</label>
                            <div class="dropdown-header">
                                <select name="minggu_ke" id="minggu_ke" class="form-control rounded-0">
                                    @foreach ($weeks as $w)
                                        <option value="{{ $w->minggu_ke }}">Minggu ke {{ $w->minggu_ke }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3">
                                <button type="button" class="dropdown-item border-top py-3" id="download-excel">
                                    <i class="far fa-file-excel fa-lg mr-2"></i>
                                    <span class="font-weight-700">Download Excel</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body m-0">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="done" role="tabpanel" aria-labelledby="done-tab">
                    @livewire('pembimbing.students.done', ['weeks' => $weeks])
                </div>
                <div class="tab-pane fade" id="missing" role="tabpanel" aria-labelledby="missing-tab">
                    @livewire('pembimbing.students.missing', ['weeks' => $weeks])
                </div>
            </div>
        </div>
    </div>
</div>
