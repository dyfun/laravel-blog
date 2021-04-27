<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yönetim Paneli') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="mb-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ $message  }}</strong>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      </span>
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-4 py-2 flex items-center w-full py-5">
                <div>
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Başlık</th>
                            <th class="px-4 py-2">Tarih</th>
                            <th class="px-4 py-2">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cats as $cat)
                            <tr>
                                <td class="border px-4 py-2">{{$cat->title}}</td>
                                <td class="border px-4 py-2">{{$cat->created_at}}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{route('categories.edit', $cat->id)}}"><button>Düzenle</button></a> |
                                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
                                        <button type="submit">Sil</button>
                                        @csrf
                                        @method('DELETE')
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
</x-app-layout>
