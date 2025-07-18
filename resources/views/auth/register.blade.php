@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Inscription')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Inscription</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
=======
@section('title', 'Inscription - E-Commerce')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i>Créer un compte
                    </h4>
                </div>
                <div class="card-body">
>>>>>>> 5e86a9d (catalogue produit)
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
<<<<<<< HEAD
                                <label for="first_name" class="form-label">Prénom</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required autofocus>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Nom</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">Ville</label>
                                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label">Code postal</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="country" class="form-label">Pays</label>
                                <input type="text" name="country" id="country" class="form-control" value="{{ old('country') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                        <a href="{{ route('login') }}" class="btn btn-link">Déjà inscrit ? Se connecter</a>
                    </form>
                </div>
=======
                                <label for="first_name" class="form-label">Prénom *</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Nom *</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">Ville</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}">
                                @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="postal_code" class="form-label">Code postal</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="country" class="form-label">Pays</label>
                                <select class="form-select @error('country') is-invalid @enderror" id="country" name="country">
                                    <option value="">Sélectionner...</option>
                                    <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                    <option value="Belgique" {{ old('country') == 'Belgique' ? 'selected' : '' }}>Belgique</option>
                                    <option value="Suisse" {{ old('country') == 'Suisse' ? 'selected' : '' }}>Suisse</option>
                                    <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                </select>
                                @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe *</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Créer mon compte
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p class="mb-0">
                        Déjà un compte ? 
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                        </a>
                    </p>
                </div>
>>>>>>> 5e86a9d (catalogue produit)
            </div>
        </div>
    </div>
</div>
@endsection 