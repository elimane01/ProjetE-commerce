@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Mon profil</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">Prénom</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', auth()->user()->first_name) }}" required autofocus>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Nom</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', auth()->user()->last_name) }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', auth()->user()->address) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">Ville</label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city', auth()->user()->city) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label">Code postal</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', auth()->user()->postal_code) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country" class="form-label">Pays</label>
                                <input type="text" name="country" id="country" class="form-control" value="{{ old('country', auth()->user()->country) }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('password.change.form') }}" class="btn btn-outline-secondary ms-2">Changer le mot de passe</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 