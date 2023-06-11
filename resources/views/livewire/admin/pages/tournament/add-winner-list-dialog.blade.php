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
        this.$refs.fileWinner.value = '';
    },
}" @open-add-dialog.window="open(event.detail)" @close-add-dialog.window="close()" x-cloak>

    <div class="absolute top-0 left-0 z-50 w-full h-full" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-show="showModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-xl sm:p-6">
                    <!--Dialog-->
                    <form wire:submit.prevent="submit" x-show="showModal" x-transition:enter="ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90">

                        <!--Title-->
                        <div class="flex items-center justify-between pb-3">
                            <p class="text-2xl font-bold">Add Winner List</p>

                            <div class="z-50 flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:bg-gray-300"
                                @click="close()">
                                <i class="text-gray-600 fa fa-times"></i>
                            </div>
                        </div>

                        <!-- content -->
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Upload File
                                </p>

                                <div>
                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 mt-2 space-x-2 text-white bg-blue-500 rounded"
                                        @click="$refs.fileWinner.click()">
                                        <span>Choose Image File..</span>
                                        <div wire:loading wire:target="fileListWinner">
                                            <x-loader size="4" />
                                        </div>
                                    </button>
                                    <input type="file" x-ref="fileWinner" wire:model="fileWinner" class="hidden"
                                        accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv" />
                                    <span class="ml-2">
                                        @if ($fileWinner)
                                            {{ $fileWinner->getClientOriginalName() }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!--Footer-->
                        <div class="flex justify-end pt-2 mt-2">
                            <button type="button"
                                class="px-4 py-2 text-indigo-500 bg-transparent rounded-lg hover:bg-gray-100 hover:text-indigo-400"
                                @click="close()">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 ml-2 text-white bg-indigo-500 rounded-lg hover:bg-indigo-400 disabled:bg-gray">
                                <i class="mr-2 fa-solid fa-circle-plus"></i>
                                Add
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
                    <!--/Dialog -->
                </div><!-- /Overlay -->
            </div>
        </div>
    </div>
</div>
