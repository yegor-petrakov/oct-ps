@props(['headers' => [], 'striped' => false])


<div class="bg-white">
  <div class="overflow-x-auto overflow-hidden">
    <table class="w-full text-sm text-left border-collapse">
      <thead>
        <tr class="bg-white border-b border-slate-200">
          @foreach ($headers as $header)
            <th class="px-4 py-3 font-semibold text-slate-400 whitespace-nowrap text-left text-sm">
              {{ $header }}
            </th>
          @endforeach
        </tr>
      </thead>

      <tbody class="divide-y divide-slate-200 {{ $striped ? '[&>tr:nth-child(even)]:bg-slate-50' : '' }}">
        {{ $slot }}

        @if (trim($slot) === '')
          <tr class="bg-white">
            <td colspan="{{ count($headers) }}" class="px-4 py-12 text-center text-slate-500">
              Нет данных для отображения
            </td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>