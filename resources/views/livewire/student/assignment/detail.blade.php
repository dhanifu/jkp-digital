<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card border-0">
                        <div class="card-title" style="font-size: 25px; color: #16285f">
                            <strong>
                                JKP PJJ Minggu Ke {{ $assignment->minggu_ke }} ({{ tanggalBulan($assignment->from_date) }} - {{ tanggalBulan($assignment->to_date) }})
                            </strong>
                            <div class="h6 text-dark">
                                <span style="font-weight: 500">JKP Digital • {{ $assignment->created_at->format('M d') }}</span>
                                <div class="float-right">
                                    <span>{!! $due_date !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mt-4">
                        <form>
                            <div class="card-header border-0" style="background: #fff">
                                <div class="card-title">
                                    <div class="float-left"><span style="font-size: 20px;">Your Work</span></div>
                                    <div class="float-right"><span style="font-size: 16px">ex. Turned in late</span></div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="form-group files">
                                    <input type="file" class="form-control" wire:model="file">
                                </div>
                            </div>

                            <div class="px-4 pb-4 ">
                                <button type="submit" class="px-4 py-1 bg-blue-600 text-white rounded">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
