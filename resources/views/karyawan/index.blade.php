<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Karyawans') }}
        </h2>
    </x-slot>

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.tailwindcss.min.css">

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-2 lg:px-1 space-y-3">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Karyawans') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">List Kayawan PT. Maju Mundur </p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('karyawans.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data Pegawai</a>
                        </div>
                    </div>

                    <div class="flow-root sm:flex-auto lg:px-8 space-y-6">
                        <!-- Add filter dropdowns -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nama-filter" class="block text-sm font-medium text-gray-700">Filter Nama:</label>
                                <select id="nama-filter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All</option>
                                    @foreach ($karyawans->pluck('nama')->unique() as $nama)
                                        <option value="{{ $nama }}">{{ $nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="jabatan-filter" class="block text-sm font-medium text-gray-700">Filter Jabatan:</label>
                                <select id="jabatan-filter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All</option>
                                    @foreach ($karyawans->pluck('jabatan')->unique() as $jabatan)
                                        <option value="{{ $jabatan }}">{{ $jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-8 overflow-x-auto sm:flex-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table id="karyawanTable" class="min-w-full table-auto sm:table-fixed">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>    
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Nama</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Jabatan</th>
                                            <th scope="col" class="py-3 pl-4 pr-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach ($karyawans as $karyawan)
                                            <tr class="even:bg-black-50">
                                                <td class="whitespace-nowrap py-1 pl-4 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                                <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">{{ $karyawan->nama }}</td>
                                                <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">{{ $karyawan->jabatan }}</td>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 text-center">
                                                    <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST">
                                                        <a href="{{ route('karyawans.show', $karyawan->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>
                                                        <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('karyawans.destroy', $karyawan->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">{{ __('Delete') }}</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 px-4">
                                    {!! $karyawans->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
     $(document).ready(function() {
    // Inisialisasi DataTables
    var table = $('#karyawanTable').DataTable({
        paging: false, // Nonaktifkan paginasi
        language: {
            search: "",
            searchPlaceholder: "Search..."
        }
    });

    // Custom filter function
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var namaFilter = $('#nama-filter').val();
            var jabatanFilter = $('#jabatan-filter').val();
            var nama = data[1]; // Kolom nama (index 1)
            var jabatan = data[2]; // Kolom jabatan (index 2)

            // Logika OR: tampilkan jika salah satu filter cocok atau filter kosong
            if (
                (namaFilter === "" || nama.includes(namaFilter)) ||
                (jabatanFilter === "" || jabatan.includes(jabatanFilter))
            ) {
                return true;
            }
            return false;
        }
    );

    // Event untuk filter nama
    $('#nama-filter').on('change', function() {
        table.draw();
    });

    // Event untuk filter jabatan
    $('#jabatan-filter').on('change', function() {
        table.draw();
    });
});

    </script>
</x-app-layout>
