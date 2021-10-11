<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> 

    

    <!-- <div class="py-8"> -->
             <div class="max-w-6xl mx-auto sm:px-6 lg:px-8"> 
                <div class="p-6 bg-blue border-b border-gray-300">
                    <!-- Create New Post here -->
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h2>Edit Channel : {{$channel->title}} </h2>
                        </div>

                        <form action="{{ route('channels.update', ['channel' => $channel->id]) }}" method="post">

                            {{csrf_field()}}

                            {{method_field('PUT')}}

                            <div class="form-group">
                                <input type="text" name="channel" value='{{ $channel->title }}' class="form-control">
                            </div>

                            <br>

                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type=submit>
                                        Update Channel
                                    </button>
                                </div>
                            </div>

                        </form>
                       
                    </div> 
                 </div> 

             </div>
       
</x-app-layout> 


