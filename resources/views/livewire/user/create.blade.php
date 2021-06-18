<div>
    <div class="flex-flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                Add User
            </p>
            <div class="leading-loose">
                <form wire:submit.prevent="store"
                      method="post"
                      class="p-5 bg-white rounded shadow-xl">
                    @csrf
                    <div class="grid grid-cols-4 gap-4">
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
                        <div class="">
                            <label class="block text-sm text-gray-600"
                                   for="email">Email</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded @error('email') border-2 border-red-300 @enderror"
                                   id="email"
                                   type="email"
                                   required=""
                                   aria-label="Email"
                                   wire:model="email">
                            @error('email')
                            <small class="text-red-500">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm text-gray-600"
                                   for="password">Password</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded @error('password') border-2 border-red-300 @enderror"
                                   id="password"
                                   type="password"
                                   required=""
                                   aria-label="Password"
                                   wire:model="password">
                            @error('password')
                            <small class="text-red-500">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="">
                            <label class="block text-sm text-gray-600"
                                   for="role">Role</label>
                            <select class="w-full px-4 py-2 text-gray-700 bg-gray-200 rounded @error('role') border-2 border-red-300 @enderror"
                                    id="role"
                                    aria-label="Role"
                                    wire:model="role">
                                <option>-- Select One --</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <small class="text-red-500">{{$message}}</small>
                            @enderror
                        </div>
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