@extends('layout')
 
@section('content')
<div class="jumbotron">
    <div class="container">
        <p>{{ $message }}</p>
 
        @if ($redirect)
        <script type="application/javascript">
            setTimeout(
                function() {
                    location.href = '{{ $redirect }}';
                },
                10000
            );
        </script>
        <p class="like-h">Click <a href="{{ $redirect }}"> this link </a>, if your browser does not support automatic redirect.</p>
        @endif
    </div>
</div>
@stop