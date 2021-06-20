<div>
    <div class="flex-flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                Add Role
            </p>
            <div class="leading-loose">
                <form wire:submit.prevent="store"
                      method="post"
                      class="p-5 bg-white rounded shadow-xl">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div class="">
                            <label class="block text-sm text-gray-600"
                                   for="name">Name</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded @error('name') border-2 border-red-300 @enderror"
                                   id="name"
                                   type="text"
                                   required=""
                                   aria-label="Name"
                                   wire:model="name">
                            @error('name')
                            <small class="text-red-500">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <label class="block text-sm text-gray-600"
                           for="role">Role</label>
                    <div class="grid grid-cols-4 gap-4">
                        {{-- @php
                        $i = 0;
                        @endphp

                        @foreach ($permissions as $permission)
                        {{ $i == 0 OR $i % 4 == 0 ? '<div>' : '' }}
                        <input type="checkbox"
                               wire:model="permissionsId"
                               value="{{ $permission->id }}">{{ $permission->name }}

                        <br>
                        @php
                        $i += 1;
                        @endphp
                        {{ $i == 0 OR $i % 4 == 0 ? '</div>' : '' }}
                        @endforeach --}}
                        @php
                        $i = 0;
                        @endphp

                        @foreach ($permissions as $permission)
                        @php
                        if($i == 0 OR $i % 4 == 0) {
                        echo '<div>';
                            }
                            @endphp
                            <div>
                                <input type="checkbox"
                                       wire:model="permissionsId"
                                       value="{{ $permission->id }}"> {{ $permission->name }}
                                <br>
                            </div>
                            @php
                            $i += 1;
                            if($i == 0 OR $i % 4 == 0) {
                            echo '</div>';
                        }
                        @endphp
                        @endforeach
                    </div>
                    <div class="mt-6">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Submit</button>
                        <button wire:click.prevent="$emit('closeUser')"
                                class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>