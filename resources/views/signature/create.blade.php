@extends('layouts.front-end')

@section('content')
    <div role="alert" class="tw-bg-blue-lightest tw-border tw-border-blue-light tw-text-blue-dark tw-px-4 tw-py-3 tw-rounded tw-relative">
        <span class="tw-sm:inline">Wij danken u alvast voor de steun en of intresse in ons referendum.</span>
    </div>

    <form method="POST" class="tw-pt-8 form-horizontal" action="">
        {{ csrf_field() }} {{-- CSRF token protection --}}

        <div class="form-group">
            <label class="control-label col-md-2"> Uw naam: <span class="text-danger">*</span></label>

            <div class="col-md-5  @error('firstname', 'has-error')">
                <input type="text" class="form-control" placeholder="Uw voornaam" @input('firstname')>
                @error('firstname')
            </div>

            <div class="col-md-5 @error('lastname', 'has-error')">
                <input type="text" class="form-control" placeholder="Uw achternaam" @input('lastname')>
                @error('lastname')
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2">Geboortedatum: <span class="text-danger">*</span> </label>

            <div class="col-md-10" @error('birth_date', 'has-error')>
                <input type="date" class="form-control"  @input('birth_date')>
                @error('birth_date')
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2"> Uw adres: <span class="text-danger">*</span></label>

            <div class="col-md-7 @error('address' , 'has-error')">
                <input type="text" class="form-control" placeholder="Uw straatcnaam" @input('address')>
                @error('address')
            </div>

            <div class="col-md-3 @error('house_number', 'has-error')">
                <input type="text" class="form-control" placeholder="Uw Huisnummer" @input('house_number')>
                @error('house_number')
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-3 @error('postal_code', 'has-error')">
                <input type="text" class="form-control" placeholder="Stadsnaam" @error('postal_code')>
                @error('postal_code')
            </div>

            <div class="col-md-7 @error('city_name', 'has-error')">
                <input type="text" class="form-control" placeholder="Stadsnaam" @error('city_name')>
                @error('city_name')
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fa fa-check"></i> Tekenen
                </button>

                <button type="reset" class="btn btn-sm btn-link">
                    <i class="fa fa-undo"></i> Annuleren
                </button>
            </div>
        </div>
    </form>
@endsection