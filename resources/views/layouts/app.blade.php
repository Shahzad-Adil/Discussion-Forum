<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="{{asset('js/toastr.min.css')}}">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @if(Auth::check())
                @include('layouts.navigation')
            @endif
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            
            <div class="container text-center">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @if(Session::has('success'))

                        <div style='color:darkgreen;background-color:lightblue;border: 1px outset green;height: 40px;padding:10px'>
                            {{Session::get('success')}}
                         </div>

                    @endif
                </div>
            </div>


            <div class="container">
                @if($errors->count() > 0)
                <br>
                    <ul class="list-group-item">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                @endif
            </div>

            <div class="container">
                <div class="row">
                <div class="col-md-3">
                    <div class="py-8">
                        <div class="max-w-6xl mx-auto sm:px-6 lg:px-0"> 
                            <div class="p-6 bg-blue border-b border-gray-300">

                                <a href="{{route('discussions.create')}}" class="form-control btn btn-primary">Create New Discussion</a>
                                <br><br>
                                <div class="panel panel-default">
                        
                                    <div class="panel-body">
                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <a href="/dashboard" style='text-decoration:none'>Home</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <a href="/dashboard?filter=me" style='text-decoration:none'>My Discussions</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <a href="/dashboard?filter=solved" style='text-decoration:none'>Answered Discussions</a>
                                                </li>  
                                                <li class="list-group-item">
                                                    <a href="/dashboard?filter=unsolved" style='text-decoration:none'>Unanswered Discussions</a>
                                                </li>                                           
                                        </ul>
                                    </div>
                                </div>
                                @if(Auth::check())
                                    @if(Auth::user()->admin)
                                    <br>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a href="/channels" style='text-decoration:none'>All Channels</a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                @endif
                                
                                <br>
                                <div class="panel panel-default">
                                    
                                    <div class="panel-heading">
                                        <h2>Channels</h2>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            @foreach($channels as $channel)
                                                <li class="list-group-item">
                                                    <a href="{{route('channel', ['slug' => $channel->slug])}}" style='text-decoration:none'>{{$channel->title}}</a>
                                                </li>
                                            @endforeach
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                   {{ $slot }}
                </div>
                </div>
            </div>

        </div>

        <!-- scripts -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            @if(Session::has('success'))
                toastr.success("{{Session::get('success')}}")
            @endif
        </script>
    </body>
</html>
