@extends('layouts.master')

@section('title','Home')

@section('content')
    <div class="container-fluid mb-4">

        @if(count($partners)>0 )
            <h1 class="h3 mb-4 text-gray-800">
                Greetings! You've found following matches:
            </h1>
            @php
                $occupations = config('mingle.occupations');
                $familyTypes = config('mingle.family_types');
            @endphp

            <div class="row">
                @foreach($partners as $partner)
                    <div class="col-sm-3" style="margin-bottom: 30px;">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h4 class="card-title">{{$partner->full_name}}</h4>
                                <p class="card-text">
                                    <b>Email:</b> {{$partner->email}}
                                    <br>
                                    <b>Occupation:</b>
                                    {{$partner->occupation && !empty($occupations[$partner->occupation])
                                     ? $occupations[$partner->occupation] : 'Not specified'}}
                                    <br>
                                    <b>Annual income:</b> ₹{{$partner->annual_income}}
                                    <b>Family type:</b>
                                    {{$partner->family_type && !empty($familyTypes[$partner->family_type])
                                     ? $familyTypes[$partner->family_type] : 'Not specified'}}
                                    <b>Manglik?:</b>
                                    @if(isset($partner->manglik))
                                        {{$partner->manglik == 1 ? "Yes" : "No"}}
                                    @else
                                        Not specified
                                    @endif
                                </p>
                                <a href="javascript:void(0);" class="btn btn-primary mr-1">Contact</a>
                                <a href="javascript:void(0);" class="btn btn-success">Message</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h1 class="h3 mb-4 text-gray-800">No matches found! Please wait</h1>
            <div class="pb-5"></div>
            <div class="pb-5"></div>
            <div class="pb-5"></div>
            <div class="pb-5"></div>
            <div class="pb-5"></div>
            <div class="pb-5"></div>
            <div class="pb-4"></div>
        @endif
    </div>
@endsection
