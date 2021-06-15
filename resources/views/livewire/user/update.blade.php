<div>
    <div class="flex-flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Add User
            </p>
            <div class="leading-loose">
                <form wire:submit.prevent="update"
                      method="post"
                      class="p-5 bg-white rounded shadow-xl">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
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
                            <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded @error('email') border-2 border-red-300 @enderror"
                                   id="email"
                                   type="text"
                                   required=""
                                   aria-label="Email"
                                   wire:model="email">
                            @error('email')
                            <small class="text-red-500">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Submit</button>
                        <button wire:click="$emit('closeCreateUser')"
                                class="px-4 py-1 text-white font-light tracking-wider bg-red-700 rounded">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>