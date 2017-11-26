@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance. --}}

        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="list-group">
                    <a href="#information" aria-controls="information" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-info-circle"></i> Account informatie
                    </a>

                    <a href="#security" aria-controls="security" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa fa-key"></i> Account beveiliging
                    </a>
                </div>
            </div> {{-- /END sidebar --}}

            <div class="col-md-9"> {{-- Content --}}

                <div class="tab-content"> {{-- Panel content --}}
                    <div role="tabpanel" class="tab-pane fade in @if (Request::segment(2) === 'information') active @endif" id="information"> {{-- Information panel --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-fw fa-info-circle"></i> Acccount informatie.
                            </div>

                            <div class="panel-body">
                                <form method="POST" class="form-horizontal" action="{{ route('account.settings.info') }}">
                                    @form($user)        {{-- Bind the user data to the form. --}}
                                    {{ csrf_field() }}  {{-- Form field protection --}}

                                    <div class="form-group @error('name', 'has-error')">
                                        <label class="control-label col-md-3"> Naam: <span class="text-danger">*</span></label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Uw gebruikersnaam" @input('name')>
                                            @error('name')
                                        </div>
                                    </div>

                                    <div class="form-group @error('email', 'has-error')">
                                        <label class="control-label col-md-3">Email adres: <span class="text-danger">*</span></label>

                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Uw email adres"  @input('email')>
                                            @error('email')
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="fa fa-check"></i> Opslaan
                                            </button>

                                            <button class="btn btn-sm btn-link" type="reset">
                                                <i class="fa fa-undo"></i> Annuleren
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> {{-- /END panel information --}}

                    <div role="tabpanel" class="tab-pane fade in @if (Request::segment(2) === 'security') active @endif }}" id="security"> {{-- Security panel --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-fw fa-key"></i> Account beveiliging
                            </div>

                            <div class="panel-body">
                                <form method="POST" class="form-horizontal" action="{{ route('account.settings.sec') }}">
                                    {{ csrf_field() }} {{-- Form field protection --}}

                                    <div class="form-group @error('password', 'has-error')">
                                        <label class="control-label col-md-3">Nieuw wachtwoord: <span class="text-danger">*</span></label>

                                        <div class="col-md-9">
                                            <input type="password" placeholder="Uw nieuw wachtwoord" class="form-control" @input('password')>
                                            @error('password')
                                        </div>
                                    </div> 

                                    <div class="form-group @error('password_confirmation', 'has-error')">
                                        <label class="control-label col-md-3">Herhaal wachtwoord: <span class="text-danger">*</span></label>

                                        <div class="col-md-9">
                                            <input type="password" placeholder="Herhaal uw nieuw wachtwoord" class="form-control" @input('password_confirmation')>
                                            @error('password_confirmation')
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-sm btn-success" type="success">
                                                <i class="fa fa-check"></i> Opslaan
                                            </button>

                                            <button class="btn btn-sm btn-link" type="reset">
                                                <i class="fa fa-undo"></i> Annuleren
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> {{-- /END security panel --}}
                </div> {{-- /END panel content --}}

            </div> {{-- /END Content --}}
        </div>
    </div>
@endsection