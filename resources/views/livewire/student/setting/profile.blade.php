<div>
    <div class="row">
        <div class="col-md-5 col-xl-4">

            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a wire:click="$emit('refreshAccount')" class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                        Account
                    </a>
                    <a wire:click="$emit('refreshPassword')" class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                        Password
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-xl-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    @livewire('student.setting.account', ['user' => $user])

                </div>

                {{-- Password --}}
                <div class="tab-pane fade" id="password" role="tabpanel">
                    @livewire('student.setting.password', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
</div>
