@extends('layouts.app')

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
                                <a class="btn btn-default btn-sm" href="">
                                    <i class="fa fa-search"></i> Gebruiker zoeken.
                                </a>
                            @endif

                            <a class="btn btn-default btn-sm" href="">
                                <i class="fa fa-user-plus"></i> Gebruiker toevoegen.
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection