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
    <h1 class="text-3xl text-black pb-6">Users</h1>

    @if (session()->has('message'))
    {{-- alert --}}
    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500 alert">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"></i>
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
        @if (Auth::user()->hasPermissionTo('create users'))
        <button wire:click="$toggle('createUser')"
                class="px-4 py-2 text-white font-light tracking-wider bg-gray-900 rounded">Tambah</button>
        @endif
        <div class="bg-white overflow-auto mt-5">
            <table id="example"
                   class="min-w-full bg-white"
                   style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Last name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Phone</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</td>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">Lian</td>
                        <td class="w-1/3 text-left py-3 px-4">Smith</td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="tel:622322662">622322662</a></td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="w-1/3 text-left py-3 px-4">Emma</td>
                        <td class="w-1/3 text-left py-3 px-4">Johnson</td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="tel:622322662">622322662</a></td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                    </tr>
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">Oliver</td>
                        <td class="w-1/3 text-left py-3 px-4">Williams</td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="tel:622322662">622322662</a></td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                    </tr>
                    <tr class="bg-gray-200">
                        <td class="w-1/3 text-left py-3 px-4">Isabella</td>
                        <td class="w-1/3 text-left py-3 px-4">Brown</td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="tel:622322662">622322662</a></td>
                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                               href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
        <script>
            $(document).ready(function(){
            window.livewire.on('alert',()=>{
                setTimeout(function(){ $(".alert").fadeOut('fast');
                }, 3000); // 3 secs
            });
        });
        </script>
    </x-slot>
</div>