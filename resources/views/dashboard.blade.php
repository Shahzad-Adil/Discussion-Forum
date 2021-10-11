<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                <br>
                @foreach($discussions as $d)
                <!-- <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> -->
                            <div class="p-6 bg-white border-b border-gray-300">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <img src="{{$d->user->avatar}}" alt="user avatar" height=50px width=50px>
                                        <span> {{$d->user->name}}, <b> {{$d->created_at->diffForHumans()}} </b> </span>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{route('discussions', ['slug' => $d->slug])}}" class="btn btn-default btn-xs pull-right">
                                            <span style='color:blue'>View</span>&nbsp;&nbsp;&nbsp;
                                            @if($d->hasBestAnswer())
                                                | &nbsp;&nbsp;&nbsp; <span style='color:green;'><b>CLOSED</b></span>
                                            @else
                                                | &nbsp;&nbsp;&nbsp;<span style='color:red'><b>OPEN</b></span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="panel-body">
                                        <h4 class="text-center">
                                            {{$d->title}}
                                        </h4>
                                        <p class="text-center">
                                            {{Str::limit($d->content, 50)}}
                                        </p>
                                        <!-- {{$d->content}} -->
                                    </div>
                                    <div class="panel-footer">
                                        <span>
                                            {{$d->replies->count()}} Replies
                                        </span>
                                        <a href="{{route('channel', ['slug'=>$d->channel->slug])}}" class='pull-right btn btn-default btn-xs'>{{$d->channel->title}}</a>
                                    </div>
                                </div>
                            </div>
                        <!-- </div>
                    </div>
                </div> -->
                    <br>
                @endforeach
                <br>
                <div class="text-center">
                    {{$discussions->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
