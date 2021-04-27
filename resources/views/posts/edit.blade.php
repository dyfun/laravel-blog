<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yönetim Paneli') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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
                <form action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Başlık</label>
                                    <input type="text" name="title" id="au_title" value="{{ $post->title }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                    <input type="text" name="slug" id="au_slug" value="{{ $post->slug }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <small>Boş bırakırsanız otomatik oluşturacaktır.</small>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <label for="content" class="block text-sm font-medium text-gray-700">İçerik</label>
                                    <textarea name="detail" id="" cols="30" rows="10" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $post->detail }}</textarea>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="cat_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                                    <select id="cat_id" name="cat_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        @foreach($cats as $cat)
                                            @if($cat->id == $post->category_id)
                                                <option value="{{ $cat-> id }}" selected>Seçili: {{ $cat->title }}</option>
                                            @else
                                                <option value="{{ $cat-> id }}">{{ $cat->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="tags" class="block text-sm font-medium text-gray-700">Etiketler</label>
                                    <input type="text" name="tags" id="tags" value="{{ $post->tags }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <label for="tags" class="block text-sm font-medium text-gray-700">Öne Çıkan Görsel</label>
                                    <input type="file" name="thumbnail" id="thumbnail" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @if($post->thumbnail)
                                        <img src="{{ asset($post->thumbnail) }}" alt="" height="250px" width="250px" class="mt-3">
                                    @endif
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
