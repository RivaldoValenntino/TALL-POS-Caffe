<div>
    <div x-data="{ open: $wire.entangle('show') }">
        <button type="button" class="add-btn" @click="open = true" wire:click="create">
            <i class="text-xl ph ph-plus"></i>
            New Category
        </button>

        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed-overlay backdrop-blur-sm">
            <div x-on:click.away="open = false; $wire.closeModal()"
                class="w-full max-w-lg mx-3 bg-white border shadow-sm modal-content rounded-xl">
                <div class="flex items-center justify-between px-4 py-3 border-b">
                    <h3 class="font-bold text-gray-800">{{ $this->modalTitle }}</h3>
                    <button type="button" @click="open = false; $wire.closeModal()"
                        class="text-sm font-semibold text-gray-800 border border-transparent rounded-full hover:bg-gray-100">
                        <span class="sr-only">Close</span>
                        <i class="ph ph-x"></i>
                    </button>
                </div>
                <div class="p-4">
                    <!-- Form -->
                    <form wire:submit.prevent="store">
                        <input type="hidden" wire:model="categoryId">
                        <div class="flex items-center justify-center">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview" width="100">
                            @elseif ($oldImage)
                                <img src="{{ asset('storage/' . $oldImage) }}" alt="Preview" width="100">
                            @endif
                        </div>
                        <div class="grid gap-y-2">
                            <div>
                                <label for="name" class="block mb-2 text-sm">Nama Kategori</label>
                                <input type="text" id="name" name="name"
                                    class="input-style @error('name') ring-rose-500 ring-1 @enderror"
                                    wire:model.defer="name">
                                @error('name')
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
                            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2">
                                <button type="button" @click="open = false; $wire.closeModal()"
                                    class="px-3 py-2 text-sm font-semibold text-white rounded-lg bg-neutral-600 hover:bg-gray-700">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    Save changes
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
