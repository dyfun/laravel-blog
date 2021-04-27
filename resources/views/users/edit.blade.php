<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yönetim Paneli') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($message = Session::get('success'))
               <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                 <strong class="font-bold">{{ $message  }}</strong>
                 <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
               </div>
            @endif
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Ad-Soyad</label>
                                    <input type="text" name="name" id="name" value="{{$user->name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700">E-posta</label>
                                    <input type="email" name="email" id="email" value="{{$user->email}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Şifre</label>
                                    <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="rank" class="block text-sm font-medium text-gray-700">Yetki</label>
                                    <select id="rank" name="rank" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @if($user->rank == 0)
                                            <option value="0" selected>Kullanıcı</option>
                                            <option value="1">Editör</option>
                                            <option value="2">Admin</option>
                                        @elseif($user->rank == 1)
                                            <option value="0">Kullanıcı</option>
                                            <option value="1" selected>Editör</option>
                                            <option value="2">Admin</option>
                                        @else
                                            <option value="0">Kullanıcı</option>
                                            <option value="1">Editör</option>
                                            <option value="2" selected>Admin</option>
                                        @endif
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Güncelle
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
