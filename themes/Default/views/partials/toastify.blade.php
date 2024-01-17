<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Toastify({
                text: @js($error),
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "center",
                style: {
                    background: "#F23B48",
                    borderRadius: "20px"
                }
            }).showToast();
        </script>
    @endforeach
@endif

<script>
    @session('status')
    Toastify({
        text: @js(session('status')),
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "center",
        style: {
            background: "#FD390F",
            borderRadius: "20px"
        }
    }).showToast();
    @endsession

    @session('error')
    Toastify({
        text: @js(session('error')),
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "center",
        style: {
            background: "#F23B48",
            borderRadius: "20px"
        }
    }).showToast();
    @endsession
</script>
