@extends('layouts.auth')

@section('title','Register')

@push('header_styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@push('header_scripts')
@endpush

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <form class="user" method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Nested Row within Card Body -->
                    <div class="row pt-4 mb-n5">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- Basic Information --}}
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-left">
                                    <h4 class="h5 text-gray-400 mt-4">Basic Information</h4>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user
                                    @error('first_name') is-invalid @enderror " id="first_name" name="first_name"
                                               value="{{ old('first_name') }}" placeholder="First Name*"
                                               required autocomplete="first_name">

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user
                                       @error('first_name') is-invalid @enderror " id="last_name" name="last_name"
                                               value="{{ old('last_name') }}" placeholder="Last Name*"
                                               required autocomplete="last_name">
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user
                                         @error('email') is-invalid @enderror " id="email" name="email"
                                               value="{{ old('email') }}" placeholder="Email*"
                                               required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="dob" class="form-control form-control-user
                                       @error('dob') is-invalid @enderror " id="dob"
                                               value="{{ old('dob') }}" placeholder="Date of Birth*" required>
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                               @error('password') is-invalid @enderror
                                               required autocomplete="new-password"
                                               name="password" id="password" placeholder="Password*">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                               name="password_confirmation" id="password_confirmation"
                                               placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                               required name="annual_income" id="annual_income"
                                               @error('annual_income') is-invalid @enderror
                                               placeholder="Annual Income*">
                                        @error('annual_income')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="Gender">Gender*</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male"
                                                   value="male" required>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female"
                                                   value="female" required>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6">
                                        <select class="form-control" id="occupation" name="occupation">
                                            <option selected disabled value="">Select Your Occupation</option>
                                            @php
                                                $occupations = config('mingle.occupations');
                                            @endphp
                                            @foreach($occupations as $key => $name)
                                                <option value="{{$key}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="family_type" name="family_type">
                                            <option selected disabled value="">Select Your Family Type</option>
                                            @php
                                                $family_types = config('mingle.family_types');
                                            @endphp
                                            @foreach($family_types as $key => $type)
                                                <option value="{{$key}}">{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <select class="form-control" id="manglik" name="manglik">
                                            <option selected disabled value="">Manglik?</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Partner Preference --}}
                        <div class="col-lg-5">
                            <div class="p-5">
                                <div class="row">
                                    <div class="text-left">
                                        <h4 class="h5 text-gray-400 mt-4">Partner Preference</h4>
                                    </div>
                                    <div class="offset-11"></div>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="pre_min_income" id="pre_min_income" readonly>
                                        <input type="hidden" name="pre_max_income" id="pre_max_income" readonly>
                                        <p>
                                            <label for="expected_income_display">Expected income:</label>
                                            <br>
                                            <input type="text" id="expected_income_display" readonly
                                                   style="border:0; color:#f6931f; font-weight:bold;">
                                        <div id="expected-income"></div>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="pre_family_type">
                                                Select Occupation
                                            </label>
                                            <select class="form-control" id="pre_occupation" name="pre_occupation[]"
                                                    multiple>
                                                @php
                                                    $occupations = config('mingle.occupations');
                                                @endphp
                                                @foreach($occupations as $key => $name)
                                                    <option value="{{$key}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="pre_family_type">
                                                Select Family Type
                                            </label>
                                            <select class="form-control" id="pre_family_type" name="pre_family_type[]"
                                                    multiple>
                                                @php
                                                    $family_types = config('mingle.family_types');
                                                @endphp
                                                @foreach($family_types as $key => $type)
                                                    <option value="{{$key}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="pre_manglik">
                                                Select Manglik
                                            </label>
                                            <select class="form-control" id="pre_manglik" name="pre_manglik">
                                                <option selected disabled value="">Select Manglik</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                                <option value="2">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-5 " style="margin: 0 auto; max-width: 30rem;">
                        <button type="submit" class="btn btn-primary btn-user btn-user-signup btn-block">
                            Register Account
                        </button>
                        <hr>
                        <button type="submit" class="btn btn-google btn-google-submit btn-user btn-block">
                            <i class="fab fa-google fa-fw"></i> Register with Google
                        </button>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('footer_scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(function () {

            // select2 init
            $("#occupation,#family,#manglik,#pre_occupation,#pre_family_type").select2({
                width: 'resolve' // need to override the changed default
            });


            // date picker init
            $("#dob").datepicker();

            // range-slider init
            $("#expected-income").slider({
                range: true,
                step: 10000,
                min: 100000,
                max: 10000000,
                values: [100000, 700000],
                slide: function (event, ui) {
                    $("#expected_income_display").val("₹" + indianFormat(ui.values[0]) +
                        " - ₹" + indianFormat(ui.values[1]));
                    $("#pre_min_income").val(ui.values[0]);
                    $("#pre_max_income").val(ui.values[1]);
                }
            });
            let min_amount = $("#expected-income").slider("values", 0);
            let max_amount = $("#expected-income").slider("values", 1);
            $("#expected_income_display").val("₹" + indianFormat(min_amount) +
                " - ₹" + indianFormat(max_amount));
            $("#pre_min_income").val(min_amount);
            $("#pre_max_income").val(max_amount);


            $(document).on('click', '.btn-google-submit', function () {
                $(document).find('form').attr('action',"{{route('google.signup')}}");
            });
            $(document).on('click', '.btn-user-signup', function () {
                $(document).find('form').attr('action',"{{route('register')}}");
            });

            // functions
            function indianFormat(input) {
                input = input.toString();
                var lastThree = input.substring(input.length - 3);
                var otherNumbers = input.substring(0, input.length - 3);
                if (otherNumbers != '')
                    lastThree = ',' + lastThree;
                return otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
            }
        });
    </script>
@endpush
