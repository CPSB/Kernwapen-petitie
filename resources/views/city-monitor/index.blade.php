@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Stedelijke monitor:
                    </div>

                    <div class="panel-body">
                        @if (count($cities) > 0) {{-- There are cities found --}}
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Postcode:</th>
                                            <th>Stadsnaam:</th>
                                            <th colspan="2">Aantal handtekeningen:</th> {{-- colspan="2" is nodig voor de functies --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cities as $city) {{-- Loop through the cities --}}
                                            <tr>
                                                <td><strong class="text-muted">#{{ $city->id }}</strong></td>
                                                <td>{{ $city->postal }}</td>
                                                <td>{{ $city->name }}</td>
                                                <td>40.0000 Handtekeningen</td> {{-- TODO: Setup relation for the signature --}}
                                                <td class="text-center"> {{-- Options --}}
                                                    <a href="" data-toggle="tooltip" data-placement="bottom" title="Activiteits geschiedenis" class="text-muted">
                                                        <i class="fa fa-info-circle fa-fw"></i>
                                                    </a>

                                                    <a href="" data-toggle="tooltip" data-placement="bottom" title="Punt toevoegen" class="text-muted">
                                                        <i class="fa fa-plus fa-fw"></i>
                                                    </a>
                                                </td> {{-- /Options --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $cities->render() }} {{-- Pagination view instance --}}
                        @else {{-- No cities found. --}}
                            <div class="alert alert-info alert-important" role="alert">
                                <strong><i class="fa fa-info-circle"></i> Info:</strong>
                                Er zijn geen steden/gemeentes gevonden in je zoekopdracht.
                            </div>
                        @endif
                    </div>
                </div>
            </div> {{-- /END content --}}

            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="well well-sm"> {{-- Search form --}}
                    <form method="POST" action="">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control" placeholder="Zoek stad">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div> {{-- /END search form --}}

                <div class="list-group"> {{-- Options --}}
                    <a href="" class="list-group-item">
                        <i class="fa fa-fw fa-plus"></i> Gebeurtenis toevoegen
                    </a>

                    <a href="" class="list-group-item">
                        <i class="fa fa-fw fa-plus"></i> Stad/Gemeente toevoegen
                    </a>
                </div> {{-- /Options --}}
            </div> {{-- /Sidebar --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush