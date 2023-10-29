<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style type="text/css">

    body{

        line-height: 1.8;    
        background-color: #f5f8fa;
    }

</style>


</head>
<body>
    {{-- nav bar header --}}
    
    {{-- menu sidebar left --}}
    <div class="container-fluid">
        <div class="row min-vh-100 flex-column flex-md-row">
            {{-- content layout --}}
            @yield('content')
            
        </div>
    </div>

</body>
</html>
