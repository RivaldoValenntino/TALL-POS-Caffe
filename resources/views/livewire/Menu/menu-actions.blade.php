<div>
    <div x-data="{ open: $wire.entangle('show') }">
        <button type="button" class="add-btn" @click="open = true" wire:click="create">
            <i class="text-xl ph ph-plus"></i>
            New Menu
        </button>

        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed-overlay backdrop-blur-sm">
            <div x-on:click.away="open = false; $wire.closeModal()"
                class="w-full max-w-lg mx-3 bg-white border shadow-sm modal-content rounded-xl">
                <div class="flex items-center justify-between px-4 py-3 border-b">
                    <h3 class="font-bold text-gray-800">{{ $this->ModalTitle }}</h3>
                    <button type="button" @click="open = false; $wire.closeModal()"
                        class="text-sm font-semibold text-gray-800 border border-transparent rounded-full hover:bg-gray-100">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <!-- Form -->
                    <form wire:submit.prevent="store">
                        <div class="flex items-center justify-center">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview" width="100">
                            @elseif ($oldImage)
                                <img src="{{ asset('storage/' . $oldImage) }}" alt="Preview" width="100">
                            @endif
                        </div>
                        <div class="grid gap-y-2">
                            <div>
                                <input type="hidden" name="menuId">
                                <label for="name" class="block mb-2 text-sm">Nama Menu</label>
                                <input type="text" id="name" name="name"
                                    class="input-style @error('name') ring-rose-500 ring-1 @enderror"
                                    wire:model.defer="name">
                                @error('name')
                                    <small class="text-rose-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="description" class="block mb-2 text-sm">Deskripsi</label>
                                <textarea id="description" name="description" class="input-style @error('description') ring-1 ring-rose-500 @enderror"
                                    wire:model.defer="description"></textarea>
                                @error('description')
                                    <small class="text-rose-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm">Harga</label>
                                <input type="text" type-currency='IDR' id="rupiah" name="price"
                                    class="input-style @error('price') ring-1 ring-rose-500 @enderror"
                                    wire:model.defer="price">
                                @error('price')
                                    <small class="text-rose-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="image" class="block mb-2 text-sm">Gambar</label>
                                <input type="file" id="image" name="image"
                                    class="input-file @error('image') ring-1 ring-rose-500 @enderror"
                                    wire:model="image">
                                @error('image')
                                    <small class="text-rose-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label for="category_id" class="block mb-2 text-sm">Kategori</label>
                                <select id="category_id" name="category_id"
                                    class="block w-full px-4 py-3 text-sm border rounded-lg -auto bg-slate-100 dark:bg-neutral-800"
                                    wire:model.defer="category_id">
                                    <option hidden>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-rose-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2">
                                <button type="button" @click="open = false; $wire.closeModal()"
                                    class="px-3 py-2 text-sm font-semibold text-white rounded-lg bg-neutral-600 hover:bg-gray-700">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <span wire:loading>Loading...</span>
                                    <span wire:loading.remove>Save changes</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</div>
