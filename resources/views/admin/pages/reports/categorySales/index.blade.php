@extends('admin.pages.layout.main')
@section('title', 'Category Sale')
@section('content')
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Category Wise Sale Report</h1>
    <div class="mt-2 md:mt-0 flex gap-2">
        
        <button onclick="window.print()"
           class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            🖨️ Print
        </button>
    </div>
</div>


    <div class="space-y-6">
       <div class="bg-white rounded-xl shadow-md p-4 w-full overflow-x-auto">
  <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
    <thead class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">
      <tr>
        <th class="px-4 py-3 whitespace-nowrap">S/L</th>
        <th class="px-4 py-3 whitespace-nowrap">Category Name</th>
        <th class="px-4 py-3 text-right whitespace-nowrap">Quantity</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      <tr class="hover:bg-gray-50">
        <td class="px-4 py-3 whitespace-nowrap">1</td>
        <td class="px-4 py-3 whitespace-nowrap">Badhakopi (Cabbage)</td>
        <td class="px-4 py-3 text-right whitespace-nowrap">17</td>
      </tr>
      
    </tbody>
  </table>
</div>

    </div>


@endsection
