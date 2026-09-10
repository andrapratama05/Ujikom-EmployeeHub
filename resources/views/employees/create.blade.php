<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tambah Data Pegawai</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('employees.store') }}" method="POST" class="space-y-4" x-data="{ isSubmitting: false }" x-on:submit="if (isSubmitting) { $event.preventDefault(); } else { isSubmitting = true; }">
                    @csrf
                    
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="sex" :value="__('Jenis Kelamin')" />
                        <select id="sex" name="sex" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('sex') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('sex') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="last_education" :value="__('Pendidikan Terakhir')" />
                        <select id="last_education" name="last_education" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="SMA" {{ old('last_education') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="D3" {{ old('last_education') == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4" {{ old('last_education') == 'D4' ? 'selected' : '' }}>D4</option>
                            <option value="S1" {{ old('last_education') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('last_education') == 'S2' ? 'selected' : '' }}>S2</option>
                        </select>
                        <x-input-error :messages="$errors->get('last_education')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="age" :value="__('Usia')" />
                        <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required />
                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 mt-4">
                        <x-primary-button x-bind:disabled="isSubmitting" x-bind:class="{ 'opacity-50 cursor-not-allowed': isSubmitting }">
                            <span x-show="!isSubmitting">{{ __('Simpan Data') }}</span>
                            <span x-show="isSubmitting" style="display: none;">{{ __('Menyimpan...') }}</span>
                        </x-primary-button>
                        <a href="{{ route('employees.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>