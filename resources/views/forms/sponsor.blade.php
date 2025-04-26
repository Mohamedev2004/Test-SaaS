@extends('layouts.forms')

@section('content')
    @if (auth()->check() && auth()->user()->isBrand())
        <a href="{{ route('brand_dashboard') }}" class="absolute top-4 left-8 text-white text-4xl">
            &larr;
        </a>
        <div class="w-full max-w-2xl bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white">Sponsoring</h2>
            <p class="text-base sm:text-lg mt-2">Déposer votre Dossier</p>
            <form action="{{ route('sponsoring_store_brand') }}" method="post" class="mt-6 text-left" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block font-medium">Nom Complet</label>
                        <input type="text" name="name" id="name" placeholder="Nom Complet"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone" class="block font-medium">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('phone') border-red-500 @enderror"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block font-medium">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="E-mail"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- File Upload Field -->
                    <div>
                        <label for="pdf" class="block font-medium">Télécharger un fichier PDF</label>
                        <label for="fileInput"
                            class="w-full mt-2 flex items-center gap-2 justify-center px-4 py-3 bg-white text-gray-800 border border-gray-300 rounded-lg shadow-sm cursor-pointer hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-3-3m3 3l3-3M8 16h8">
                                </path>
                            </svg>
                            <span id="fileName" class="text-gray-600">Document</span>
                            <input id="fileInput" type="file" name="pdf" accept=".pdf"
                                class="hidden @error('pdf') border-red-500 @enderror">
                        </label>
                        @error('pdf')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <button type="submit" class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">Envoyer</button>
            </form>
            
        </div>
    @endif

    @if (auth()->check() && auth()->user()->isInfluencer())
        <a href="{{ route('influencer_welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
            &larr;
        </a>
        <div class="w-full max-w-2xl bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white">Sponsoring</h2>
            <p class="text-base sm:text-lg mt-2">Déposer votre Dossier</p>
            <form action="{{ route('sponsoring_store_influencer') }}" method="post" class="mt-6 text-left" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block font-medium">Nom Complet</label>
                        <input type="text" name="name" id="name" placeholder="Nom Complet"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone" class="block font-medium">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('phone') border-red-500 @enderror"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block font-medium">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="E-mail"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- File Upload Field -->
                    <div>
                        <label for="pdf" class="block font-medium">Télécharger un fichier PDF</label>
                        <label for="fileInput"
                            class="w-full mt-2 flex items-center gap-2 justify-center px-4 py-3 bg-white text-gray-800 border border-gray-300 rounded-lg shadow-sm cursor-pointer hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-3-3m3 3l3-3M8 16h8">
                                </path>
                            </svg>
                            <span id="fileName" class="text-gray-600">Document</span>
                            <input id="fileInput" type="file" name="pdf" accept=".pdf"
                                class="hidden @error('pdf') border-red-500 @enderror">
                        </label>
                        @error('pdf')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <button type="submit" class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">Envoyer</button>
            </form>
        </div>
    @endif

    @guest
        <a href="{{ route('welcome') }}" class="absolute top-4 left-8 text-white text-4xl">
            &larr;
        </a>
        <div class="w-full max-w-2xl bg-purple-500 p-6 sm:p-10 rounded-3xl shadow-lg text-white text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white">Sponsoring</h2>
            <p class="text-base sm:text-lg mt-2">Déposer votre Dossier</p>
            <form action="{{ route('sponsoring_store') }}" method="post" class="mt-6 text-left" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block font-medium">Nom Complet</label>
                        <input type="text" name="name" id="name" placeholder="Nom Complet"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Phone Number Field -->
                    <div>
                        <label for="phone" class="block font-medium">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" placeholder="Numéro de téléphone"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('phone') border-red-500 @enderror"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block font-medium">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="E-mail"
                            class="w-full px-4 py-3 mt-2 bg-white text-gray-800 border-none rounded-lg focus:outline-none @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- File Upload Field -->
                    <div>
                        <label for="pdf" class="block font-medium">Télécharger un fichier PDF</label>
                        <label for="fileInput"
                            class="w-full mt-2 flex items-center gap-2 justify-center px-4 py-3 bg-white text-gray-800 border border-gray-300 rounded-lg shadow-sm cursor-pointer hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-3-3m3 3l3-3M8 16h8">
                                </path>
                            </svg>
                            <span id="fileName" class="text-gray-600">Document</span>
                            <input id="fileInput" type="file" name="pdf" accept=".pdf"
                                class="hidden @error('pdf') border-red-500 @enderror">
                        </label>
                        @error('pdf')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <button type="submit" class="w-full mt-6 bg-purple-900 text-white py-3 rounded-lg hover:bg-purple-950 transition">Envoyer</button>
            </form>
        </div>
    @endguest
@endsection
