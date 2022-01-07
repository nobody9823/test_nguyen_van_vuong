@php
use \Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title_content')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    axios.defaults.baseURL = '{{ config("app.axios_baseURL") }}';
    </script>
    @yield('css')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            @yield('header_content')
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar border">
                <div class="sidebar-sticky">
                    @yield('side_bar_content')
                </div>
            </nav>

            <main class="col-md-9 mx-sm-auto col-lg-10 pt-3 px-4">
                <div class="container-fluid">
                    @if (session('flash_message'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('flash_message') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @yield('script')

    <script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">

    <script>
        $(function () {
        $("#start_date").datetimepicker({
            format: 'Y-m-d H:i:s'
        });
        $("#end_date").datetimepicker({
            format: 'Y-m-d H:i:s'
        });
        $(".datetime_picker").datetimepicker({
            format: 'Y-m-d H:i:s'
        });
        $(".date_picker").datetimepicker({
            format: 'Y-m-d'
        });
    });

    </script>

</body>

</html>
