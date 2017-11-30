@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-12"> {{-- Content col --}}
                <div class="panel panel-default"> {{-- Content panel --}}
                    <div class="panel-heading"> {{-- Panel heading --}}
                        <i class="fa fa-user-plus"></i> Gebruiker toevoegen

                        <a href="{{ route('users.index') }}" class="pull-right btn btn-default btn-xs">
                            <i class="fa fa-users"></i> Gebruikers overzicht.
                        </a>
                    </div>

                    <div class="panel-body"> {{-- Panel content --}}
                        <div role="alert" class="alert alert-info fade in alert-important alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><i class="fa fa-info-circle"></i> Info:</strong>
                            Een wachtwoord zal automatisch gegenereerd worden en vervolgens naar de gebruiker gemaild worden.
                        </div>

                        <form action="{{ route('users.store') }}}" method="POST" class="form-horizontal"> {{-- Create new user form --}}
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('name', 'has-error')">
                                <label class="control-label col-md-3">Naam van de gebruiker: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Gebruikersnaam" @input('name')>
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group @error('email', 'has-error')">
                                <label class="control-label col-md-3">Email adres van de gebruiker: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="email" class="form-control" placeholder="Zijn/Haar email adres" @input('email')>
                                    @error('email')
                                </div>
                            </div>

                            <div class="form-group @error('role', 'has-error')">
                                <label class="control-label col-md-3">Permissie niveau v/d gebruiker: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <select class="form-control" @input('role')>
                                        <option value="">-- Selecteer het gebruikers niveau --</option>

                                        @foreach ($roles as $role) {{-- Loop trough the permissions --}}
                                            <option value="{{ $role->id }}" @if ($role->id == old('role')) selected @endif>{{ ucfirst($role->name) }}</option>
                                        @endforeach {{-- /END loop --}}
                                    </select>

                                    @error('role') {{-- Validation error message instance. --}}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-check"></i> Opslaan
                                    </button>

                                    <button type="reset" class="btn btn-sm btn-danger">
                                        <i class="fa fa-undo"></i> Annuleren
                                    </button>
                                </div>
                            </div>
                        </form> {{-- /Create new user form --}}
                    </div> {{-- /END panel content --}}
                </div> {{-- /Content panel --}}
            </div> {{-- /END Content col --}}
        </div>
    </div>
@endsection