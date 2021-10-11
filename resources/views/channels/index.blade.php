 <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> 

    

    <div class="py-8">
             <div class="max-w-6xl mx-auto sm:px-6 lg:px-8"> 
                <div class="p-6 bg-blue border-b border-gray-300">
                    <!-- Create New Post here -->
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            <h2>Channels</h2>
                        </div>
                        <div class='panel-body'>
                            <table class="table table-hover">
                                <thead>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Edit
                                    </th>
                                    <th>
                                        Delete
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach($channels as $channel)
                                        <tr>
                                            <td> {{$channel->title}} </td>
                                            <td>
                                                <a href=" {{route('channels.edit',['channel' => $channel->id])}} " class='btn btn-xs btn-info'>Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{route('channels.destroy',['channel' => $channel->id])}}" method="post">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button class='btn btn-xs btn-danger'>Destroy</button>
                                                </form>
                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                 </div> 

             </div>
</div>
</x-app-layout> 


