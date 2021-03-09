<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
<script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libraries/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="https://kit.fontawesome.com/f38b57ad54.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".menu-icon").click(function(){
            $(".wrapper").toggleClass("active");
        })
    });
</script>

<!-- Livewire Script -->
<livewire:scripts />

@stack('script')