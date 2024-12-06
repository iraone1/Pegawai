<div class="space-y-6">
    
    <div>
        <x-input-label for="nama" :value="__('Nama')"/>
        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $karyawan?->nama)" autocomplete="nama" placeholder="Nama"/>
        <x-input-error class="mt-2" :messages="$errors->get('nama')"/>
    </div>
    <div>
        <x-input-label for="jabatan" :value="__('Jabatan')"/>
        <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full" :value="old('jabatan', $karyawan?->jabatan)" autocomplete="jabatan" placeholder="Jabatan"/>
        <x-input-error class="mt-2" :messages="$errors->get('jabatan')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>