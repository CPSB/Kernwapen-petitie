@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Include flash session view instance. --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users"></i> Gebruikersbeheer

                        <div class="pull-right">
                            @if (count($users) > 10)
                                <a class="btn btn-default btn-xs" href="">
                                    <i class="fa fa-search"></i> Gebruiker zoeken.
                                </a>
                            @endif

                            <a class="btn btn-default btn-xs" href="{{ route('users.create') }}">
                                <i class="fa fa-user-plus"></i> Gebruiker toevoegen.
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Status</th>
                                        <th>Naam:</th>
                                        <th>Email:</th>
                                        <th colspan="2">Aangemaakt op:</th> {{-- Colspan="2" nodig voor de functies --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) == 0) {{-- No users found --}}
                                        <tr>
                                            <td colspan="6"><i>(Er zijn geen gebruikers gevonden.)</i></td>
                                        </tr>
                                    @else {{-- There are users found --}}
                                        @foreach ($users as $user) {{-- Loop through the users --}}
                                            <tr>
                                                <td><strong>#{{ $user->id }}</strong></td>
                                                <td>
                                                    @if ($user->isBanned()) {{-- User is banned --}}
                                                        <label class="label label-danger"><i class="fa fa-ban"></i> Geblokkeerd</label>
                                                    @else {{-- The user is active --}}
                                                        <label class="label label-success"><i class="fa fa-check"></i> Actief</label>
                                                    @endif
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->diffForHumans() }}</td>

                                                <td class="text-center"> {{-- Options --}}
                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-pencil"></i>
                                                    </a>

                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-ban"></i>
                                                    </a>

                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </td> {{-- /Options --}}
                                            </tr>
                                        @endforeach {{-- END loop --}}
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
