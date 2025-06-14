<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>เข้าสู่ระบบ</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

   
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <div class="container">

          <div class="row">
            <div class="col text-center">


                <a
                    href="https://domainapi/oauth2/authorize?response_type=code&client_id=c02cc2130a15083e9344c1c268ca8202&redirect_uri=http://127.0.0.1:8230/callback&scope=username+name+lastname&state=xxxxxxxx">เข้าด้วยระบบ
                    RMUTT</a>


            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>
