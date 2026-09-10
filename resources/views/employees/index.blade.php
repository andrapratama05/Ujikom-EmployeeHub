<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Data Pegawai
      </h2>
      <a href="{{ route('employees.create') }}"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah Data</a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if(session('success'))
        <div id="success-alert" class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-800 dark:text-green-200 px-4 py-3 rounded relative mb-4 flex justify-between items-center transition-opacity duration-500">
          <span>{{ session('success') }}</span>
          <button type="button" onclick="document.getElementById('success-alert').remove()" class="text-green-800 dark:text-green-200 font-bold text-lg leading-none hover:opacity-75">&times;</button>
        </div>
      @endif

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
          <table id="employeeTable" class="w-full text-left border-collapse">
            <thead>
              <tr class="border-b border-gray-200 dark:border-gray-700">
                <th class="p-3">No</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Kelamin</th>
                <th class="p-3">Usia</th>
                <th class="p-3">Pendidikan Terakhir</th>
                <th class="p-3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($employees as $employee)
                <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="p-3">{{ $loop->iteration }}</td>
                  <td class="p-3">{{ $employee->name }}</td>
                  <td class="p-3">{{ $employee->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                  <td class="p-3">{{ $employee->age }} tahun</td>
                  <td class="p-3">{{ $employee->last_education }}</td>
                  <td class="p-3">
                    <a href="{{ route('employees.edit', $employee->id) }}"
                      class="text-yellow-500 hover:text-yellow-600 inline-block p-1" title="Edit">
                      <i class="fa-solid fa-pen-to-square text-lg"></i>
                    </a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:text-red-600 inline-block p-1 ml-2"
                        title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="fa-solid fa-trash-can text-lg"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
  <style>
    .dataTables_wrapper {
        width: 100%;
        clear: both;
    }

    .dataTables_wrapper .dataTables_length {
        float: left;
        margin-bottom: 1rem;
    }
    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    .dataTables_wrapper .dataTables_filter input {
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
    }
    
    .dataTables_wrapper .dataTables_length select {
        padding: 0.375rem 2rem 0.375rem 0.75rem;
        border-radius: 0.375rem;
    }

    .dataTables_wrapper table.dataTable {
        width: 100% !important;
        clear: both;
        margin-top: 0.75rem !important;
        margin-bottom: 0.75rem !important;
    }

    .dataTables_wrapper .dataTables_info {
        float: left;
        padding-top: 0.75rem;
        font-size: 0.875rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        padding-top: 0.5rem;
    }

    .dataTables_wrapper::after {
        content: "";
        display: table;
        clear: both;
    }

    /* Styling Tombol Pagination DataTables */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.375rem 0.75rem !important;
        margin-left: 0.25rem !important;
        border-radius: 0.375rem !important;
        border: 1px solid #e5e7eb !important;
        background: #ffffff !important;
        color: #374151 !important;
        cursor: pointer;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #2563eb !important; /* blue-600 */
        color: #ffffff !important;
        border-color: #2563eb !important;
        font-weight: 600;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f3f4f6 !important;
        color: #111827 !important;
    }

    /* Styling Dark Mode DataTables & Pagination */
    .dark .dataTables_wrapper .dataTables_length select, 
    .dark .dataTables_wrapper .dataTables_filter input {
        background-color: #374151;
        color: #f3f4f6;
        border-color: #4b5563;
    }
    .dark .dataTables_wrapper .dataTables_info,
    .dark .dataTables_wrapper .dataTables_length,
    .dark .dataTables_wrapper .dataTables_filter,
    .dark .dataTables_wrapper .dataTables_paginate {
        color: #d1d5db !important;
    }
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button {
        background: #374151 !important;
        color: #d1d5db !important;
        border-color: #4b5563 !important;
    }
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: #2563eb !important;
        color: #ffffff !important;
        border-color: #2563eb !important;
        font-weight: 600;
    }
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #4b5563 !important;
        color: #ffffff !important;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#employeeTable').DataTable({
        "order": [],
        "stateSave": true
      });

      // Auto-hide alert setelah 4 detik
      setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
          alert.style.opacity = '0';
          setTimeout(() => alert.remove(), 500);
        }
      }, 4000);
    });
  </script>

</x-app-layout>