<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Créer un locataire') }}
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

                <form method="POST" action="{{ route('locataire.store') }}">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Nom
                        </label>
                        <input type="text" name="nom" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Téléphone
                        </label>
                        <input type="text" name="tel" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                                Mail
                        </label>
                        <input type="text" name="mail" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;"  >
                            Adresse
                        </label>
                        <input type="text" name="adresse" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;"  >
                            Compte Bancaire
                        </label>
                        <input type="text" name="compte_bancaire" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <button type="submit" style="color: rgb(0, 0, 0); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                        Créer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 