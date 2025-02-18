<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Créer une box') }}
        </h2>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                @if ($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('boxes.store') }}">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Nom
                        </label>
                        <input type="text" name="name" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Description
                        </label>
                        <textarea name="description" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></textarea>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Prix
                        </label>
                        <input type="number" step="0.01" name="price" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Stockage (m²)
                        </label>
                        <input type="number" name="stockage" value="{{ old('stockage') }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <button type="submit" style="color: rgb(0, 0, 0); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                        Créer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 