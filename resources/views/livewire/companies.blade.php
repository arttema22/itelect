<div>
    <button wire:click="create" type="button"
        class="w-10 h-10 inline-flex items-center justify-center rounded-full border-none outline-none bg-purple-600 hover:bg-purple-700 active:bg-purple-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="14px" fill="#fff" class="inline" viewBox="0 0 512 512">
            <path
                d="M467 211H301V45c0-24.853-20.147-45-45-45s-45 20.147-45 45v166H45c-24.853 0-45 20.147-45 45s20.147 45 45 45h166v166c0 24.853 20.147 45 45 45s45-20.147 45-45V301h166c24.853 0 45-20.147 45-45s-20.147-45-45-45z"
                data-original="#000000" />
        </svg>
    </button>

    <div class="font-sans overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100 whitespace-nowrap">
                <tr>
                    <th class="p-4 text-left text-xs font-semibold text-gray-800">
                        Name
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-800">
                        Address
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-800">
                        inn
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-800">
                        kpp
                    </th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-800">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="whitespace-nowrap">
                @foreach($companies as $company)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 text-[15px] text-gray-800">
                        {{ $company->name }}
                    </td>
                    <td class="p-4 text-[15px] text-gray-800">
                        {{ $company->address }}
                    </td>
                    <td class="p-4 text-[15px] text-gray-800">
                        {{ $company->inn }}
                    </td>
                    <td class="p-4 text-[15px] text-gray-800">
                        {{ $company->kpp }}
                    </td>
                    <td class="p-4">
                        <button wire:click="edit({{ $company->id }})" class="mr-4" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-blue-500 hover:fill-blue-700"
                                viewBox="0 0 348.882 348.882">
                                <path
                                    d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                    data-original="#000000" />
                                <path
                                    d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                    data-original="#000000" />
                            </svg>
                        </button>
                        <button wire:click="confirmDelete({{ $company->id }})" class="mr-4" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                    data-original="#000000" />
                                <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                    data-original="#000000" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @if($editForm)
    <x-dialog-modal wire:model="editForm">

        <x-slot name="title">
            @if ( $createOrUpdate )
            Edit {{ $name }}
            @else
            Create
            @endif

            <x-validation-errors class="mb-4" />

        </x-slot>

        <x-slot name="content">

            <div class="space-y-6 px-4 max-w-sm mx-auto font-[sans-serif]">
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">Name</label>
                    <input type="text" wire:model="name" placeholder="Name" />
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">Address</label>
                    <input type="text" wire:model="address" placeholder="Address"></input>
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">inn</label>
                    <input type="text" wire:model="inn" placeholder="inn">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">kpp</label>
                    <input type="text" wire:model="kpp" placeholder="kpp">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">director</label>
                    <input type="text" wire:model="director" placeholder="director">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">accountant</label>
                    <input type="text" wire:model="accountant" placeholder="accountant">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">bank_rs</label>
                    <input type="text" wire:model="bank_rs" placeholder="bank_rs">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">bank_bik</label>
                    <input type="text" wire:model="bank_bik" placeholder="bank_bik">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">bank_ks</label>
                    <input type="text" wire:model="bank_ks" placeholder="bank_ks">
                </div>
                <div class="flex items-center">
                    <label class="text-gray-400 w-36 text-sm">bank_name</label>
                    <input type="text" wire:model="bank_name" placeholder="bank_name">
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('editForm')" wire:loading.attr="disabled">
                Nevermind
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="store" wire:loading.attr="disabled">
                Save
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    @endif

    @if($confirmingDeletion)
    <x-confirmation-modal wire:model="confirmingDeletion">
        <x-slot name="title">
            Delete
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete company?
            Once company is deleted,
            all of its resources and
            data will
            be permanently deleted.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                Delete
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
    @endif

</div>