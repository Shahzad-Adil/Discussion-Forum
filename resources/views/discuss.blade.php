<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> 

    

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8"> 
            <div class="p-6 bg-blue border-b border-gray-300">
                <div class='panel panel-default'>
                    <div class='panel-heading text-center'>
                        <h2>Create a new Discussion</h2>
                    </div>
                    <div class='panel-body'>
                        <form action="{{route('discussions.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{old('title')}}" class='form-control'>
                            </div>
                            <div class="form-group">
                                <label for="channel_id">Pick a channel</label>
                                <select name="channel_id" id="channel_id" class='form-control'>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}"> {{$channel->title}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Ask a question</label>
                                <textarea name="content" id="content" cols="30" rows="10" class='form-control'>{{old('content')}}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success pull-right" type='submit'>
                                                Create Discussion
                                </button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div> 

        </div>
    </div>
</x-app-layout> 