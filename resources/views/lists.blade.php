<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"></link>
    @vite('resources/css/app.css') 
    <title>ToDoList</title>
</head>
<body class="flex justify-center items-center bg-slate-100">
    
    <div class="bg-white p-8 rounded shadow-md border w-full max-w-3xl mt-1">
        <h1 class="text-2xl font-bold text-center mb-6">ToDoList</h1>
        <form class="mb-6" action="/storeLists" method="POST">
            @csrf
            <input type="text" name="title" placeholder="The todo title" class="w-full p-3 mb-4 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <textarea name="description" placeholder="The todo description" class="w-full p-3 mb-4 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-green-600">Add <i class="fa-solid fa-plus"></i></button>
        </form>
        <div class="md:flex md:justify-between">
            <div>
                <h3 class="text-lg font-bold">Your tasks</h3>
            </div>
            <div class="md:flex">
                <h3 class="pr-5 font-medium text-lg text-gray-700">Filter🔎:</h3>
                <div class="flex md:justify-between mb-6">
                    <a href="/" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mx-2">All</a>
                    <a href="{{ route('lists.done') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Done</a>
                    <a href="{{ route('lists.progress') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mx-2">In Progress</a>
                </div>
                
            </div>
        </div>
        <div class="h-80 scrollBar">
            @if (count($lists) > 0)
                @foreach ($lists as $todo)
                <div class="flex justify-end">
                    <div @class(['p-1 w-20 pl-2.5 rounded-t-sm bg-green-300 translate-y-8', $todo->isDone ? 'opacity-100' : 'opacity-0',])>
                        <p class="opacity-80">Done✔️</p>
                    </div>
                </div>
                    <div 
                        @class([
                            'bg-white p-4 rounded shadow-sm mb-4 overflow-hidden border',
                            // 'bg-green' => $todo->isDone
                            // $todo->isDone ? 'bg-green-200' : '',
                        ])
                    >   
                        <article class="text-wrap">
                            <h2 class="font-bold">{{ $todo->title }}</h2>
                            <p>{{ $todo->description }}</p>
                        </artical>

                        <div class="flex justify-end mt-2">
                            <form method="POST" action="/{{ $todo->id }}">
                                @csrf
                                @method('PATCH')
                                <button @class(['bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600', 'hidden' => $todo->isDone])><i class="fas fa-check"></i></button>
                            </form>
                            <button onclick="deleteTaskModal{{$todo->id}}.showModal()" class="bg-red-400 text-white px-3 py-1 rounded hover:bg-red-600"><i class="fas fa-trash"></i></button>
                        </div>
                        {{-- Modal to ask to delete task --}}
                        <dialog id="deleteTaskModal{{$todo->id}}" class="modal w-96">
                            <div class="modal-box p-6 rounded-lg">
                              <h3 class="text-lg font-bold">Remove Task</h3>
                              <p class="py-4">Are you sure?</p>
                              <div class="modal-action flex justify-end">
                                <form method="dialog">
                                  <!-- if there is a button in form, it will close the modal -->
                                  <button class="bg-slate-100 p-3 hover:bg-slate-200 rounded-sm">Close</button>
                                </form>
                                <form method="POST" action="/{{ $todo->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white p-3 ml-2 px-8 rounded hover:bg-red-600"><i class="fas fa-trash"></i></button>
                                </form>
                              </div>
                            </div>
                        </dialog>
                    </div>
                  
                @endforeach
            @else 
                <div class="bg-white p-4 rounded shadow-sm mb-4 overflow-hidden">
                   <img class="h-44 mx-auto" src="{{ asset('storage/images/empty-data.jpg') }}" alt="">
                </div>
            @endif
        </div>
    </div>
</body>
</html>