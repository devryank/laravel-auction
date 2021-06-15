<div>
    <x-slot name="css">
        <!--Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"
              rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
              rel="stylesheet">

        <script type="text/javascript"
                src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    </x-slot>

    @if ($createUser)
    @livewire('user.create')
    @endif
    @if ($editUser)
    @livewire('user.update')
    @endif
    <h1 class="text-3xl text-black pb-6">Users</h1>

    @if (session()->has('message'))
    {{-- alert --}}
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-{{session('color')}}-500 alert">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-check"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            {{session('message')}}
        </span>
        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none"
                onclick="closeAlert(event)">
            <span>×</span>

        </button>
    </div>
    @endif

    <div class="w-full">

        <div class="grid grid-cols-6">

            @if (Auth::user()->hasPermissionTo('create users'))
            <div>
                <button wire:click="$toggle('createUser')"
                        class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded">Tambah</button>
                @endif
            </div>
            <div class="col-start-5 col-span-2 text-right">
                <select wire:model="paginate"
                        class="px-3 py-2 bg-gray-200">
                    <option value="
                5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
                <input wire:model="search"
                       type="text"
                       class="px-3 py-2 bg-gray-200"
                       placeholder="Search">
            </div>
        </div>

        <div class="bg-white overflow-auto mt-5">
            <table class="min-w-full bg-white"
                   style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Level</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">{{$user->name}}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{$user->email}}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{$user->roles->pluck('name')->implode(', ')}}</td>
                        <td class="w-1/3 text-left py-3 px-4">
                            <div class="flex space-x-2">
                                @if (Auth::user()->hasPermissionTo('update users') AND Auth::user()->id == $user->id)
                                <button wire:click="editUser({{$user->id}})"
                                        class="px-3 py-2 text-white font-light tracking-wider bg-yellow-700 rounded">Edit</button>
                                @else
                                <button class="px-3 py-2 text-white font-light tracking-wider bg-yellow-700 rounded opacity-50"
                                        disabled>Edit</button>
                                @endif
                                <button
                                        class="px-3 py-2 text-white font-light tracking-wider bg-red-700 rounded">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$users->links()}}
    </div>

    <x-slot name="js">
        <script id="rendered-js">
            $(document).ready(function () {

        var table = $('#example').DataTable({
            responsive: true }).

        columns.adjust().
        responsive.recalc();
        });
        //# sourceURL=pen.js
        </script>
        <script>
            function closeAlert(event){
          let element = event.target;
          while(element.nodeName !== "BUTTON"){
            element = element.parentNode;
          }
          element.parentNode.parentNode.removeChild(element.parentNode);
        }
        </script>
    </x-slot>
</div>