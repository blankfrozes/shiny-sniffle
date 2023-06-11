<div>
    <div x-data="{
        showModal: false,
        open(payload) {
            this.showModal = true;
            document.body.style.overflow = 'hidden';
            @this.init(payload);
        },
        close() {
            this.showModal = false;
            @this.resetForm();
            document.body.style.overflow = 'auto';
        },
    }" @open-edit-dialog.window="open(event.detail)" @close-edit-dialog.window="close()" x-cloak>
        <div class="absolute top-0 left-0 z-50 w-full h-full" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            x-show="showModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                        <form wire:submit.prevent="submit" x-show="showModal" x-transition:enter="ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-90">

                            <!--Title-->
                            <div class="flex items-center justify-between pb-3">
                                <p class="text-2xl font-bold">Edit Config</p>
                            </div>

                            <div class="space-y-2">
                                <x-admin.text-box name="name" label="Config Key" readonly="true" />

                                <x-admin.input-date name="config.value" label="Value" placeholder="Choose Date" />
                            </div>

                            <!--Footer-->
                            <div class="flex justify-end pt-2 mt-2">
                                <button type="button"
                                    class="px-4 py-2 bg-transparent rounded-lg text-blakc hover:bg-gray-100"
                                    @click="close()">
                                    Cancel
                                    <span class="ml-2 text-red-500">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </button>

                                <button type="submit"
                                    class="px-4 py-2 ml-2 text-white bg-blue-700 rounded-lg hover:bg-blue-500 disabled:bg-gray">
                                    Update
                                    <span class="ml-2 text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </button>
                            </div>

                            <div wire:loading wire:target="submit" class="absolute top-0 left-0 w-full h-full">
                                @include('include.full-screen-spinner')
                            </div>
                            @if ($initializing)
                                <div class="absolute top-0 left-0 w-full h-full">
                                    @include('include.full-screen-spinner')
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
