<div>
    <div class="card shadow">
        <div class="card-header">
            <h5 class="card-title mb-0">Password</h5>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <span>{{ session('success') }}</span>
                    <button class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <form>
                <div class="form-group">
                    <label for="password">Current password</label>
                    <input type="password" wire:model="password" class="form-control" id="password">
                    <small><a href="#">Forgot your password?</a></small>
                </div>
                <div class="form-group">
                    <label for="new_password">New password</label>
                    <input type="password" wire:model="new_password" class="form-control" id="new_password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Verify password</label>
                    <input type="password" wire:model="password_confirmation" class="form-control" id="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>

        </div>
    </div>
</div>
