<div>
    <div class="card">
        <div class="card-header">
            <div class="card-actions float-right">
                <div class="dropdown show">
                    <a href="#" data-toggle="dropdown" data-display="static">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h5 class="card-title mb-0">Info</h5>
        </div>
        <div class="card-body">
            {{-- <form> --}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" id="nis" value="{{ $user->nis }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="rombel">Rombel</label>
                            <input type="text" class="form-control" id="rombel" value="{{ $user->rombel->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="rayon">Rayon</label>
                            <input type="text" class="form-control" id="rayon" value="{{ $user->rayon->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <img alt="{{ $user->name }}" src="{{ profileImage() }}" class="rounded-circle img-responsive mt-2 mx-auto" width="128" height="128">
                            <div class="mt-2">
                                <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
                            </div>
                            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                        </div>
                    </div>
                </div>

                {{-- <button type="submit" class="btn btn-primary">Save changes</button>
            </form> --}}

        </div>
    </div>
</div>
