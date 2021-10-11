<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-400">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img src="{{$dd->user->avatar}}" alt="user avatar" height=50px width=50px>
                            <span> {{$dd->user->name}}, <b> ({{$dd->user->points}}) </b> </span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{route('discussions', ['slug' => $dd->slug])}}" class="btn btn-default btn-xs pull-right">
                                @if($dd->is_being_watched_by_auth_user())
                                    <a href="{{route('discussion.unwatch', ['id' => $dd->id])}}" style='color:blue; text-decoration:none'>Unwatch</a>
                                @else
                                    <a href="{{route('discussion.watch' , ['id' => $dd->id])}}" style='color:blue; text-decoration:none'>Watch</a>
                                @endif

                                @if(Auth::id() == $dd->user_id)
                                    @if(!$dd->hasBestAnswer())
                                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="{{route('discussion.edit', ['slug' => $dd->slug])}}" style='color:purple; text-decoration:none'>Edit</a>
                                    @endif
                                @endif

                                @if($dd->hasBestAnswer())
                                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <span style='color:green;'><b>CLOSED</b></span>
                                @else
                                    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<span style='color:red'><b>OPEN</b></span>
                                @endif
                            </a>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">
                                {{$dd->title}}
                            </h4>
                            <hr>
                            <p class="text-center">
                                {{$dd->content}}
                            </p>

                            @if($best_answer)
                                <div >
                                    <hr>
                                    <h3 class="text-center">
                                        Best Answer
                                    </h3>
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <img src="{{$best_answer->user->avatar}}" alt="user avatar" height=50px width=50px>
                                            {{$best_answer->user->name}}, <b> ({{$best_answer->user->points}}) </b> 
                                        </div>
                                        <div class="panel-body">
                                            {{$best_answer->content}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                                        
                        </div>
                        <div class="panel-footer">
                            <span>
                                {{$dd->replies->count()}} Replies
                            </span>
                            <a href="{{route('channel', ['slug'=>$dd->channel->slug])}}" class='pull-right btn btn-default btn-xs'>{{$dd->channel->title}}</a>

                        </div>
                    </div>
                </div>

                @foreach($dd->replies as $r)
                    <div class="p-6 bg-white border-b border-gray-300">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <img src="{{$r->user->avatar}}" alt="user avatar" height=50px width=50px>
                                <span> {{$r->user->name}}, <b> ({{$r->user->points}}) </b> </span>&nbsp;&nbsp;&nbsp;&nbsp;
                                @if(!$best_answer)
                                    @if(Auth::id() == $dd->user->id)
                                        <a href="{{route('reply.best.answer', ['id' => $r->id])}}" class='btn btn-xs btn-info pull-right'>Mark as best answer</a>
                                    @endif
                                @endif
                                @if(Auth::id() == $r->user_id)
                                    @if(!$r->best_answer)
                                        <a href="{{route('reply.edit', ['id' => $r->id])}}" class='btn btn-xs btn-info pull-right'>Edit</a>
                                    @endif
                                @endif
                            </div>
                            <hr>

                            <div class="panel-body">
                                <p class="text-center">
                                    {{$r->content}}
                                </p>
                                            
                            </div>
                            <div class="panel-footer">
                                @if($r->is_liked_by_auth_user())
                                    <a href="{{route('reply.unlike', ['id' =>$r->id])}}" class='btn btn-danger btn-xs'>Unlike <span class='badge'>{{$r->likes->count()}} </span></a>
                                @else
                                    <a href="{{route('reply.like', ['id' =>$r->id])}}" class='btn btn-success btn-xs'>Like <span class='badge'>{{$r->likes->count()}} </span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="p-6 bg-white border-b border-gray-300">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if(Auth::check())
                                <form action="{{route('discussions.reply', ['id' => $dd->id])}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="reply">Leave a Reply...</label>
                                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-info pull-right">
                                            Leave a reply
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center">
                                    <h2>Sign In to leave a reply</h2>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
