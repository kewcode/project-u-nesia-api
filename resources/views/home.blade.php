@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body row">

                    <div class="col-sm-6 col-lg-6 mt-2">
                        <a href="{{ url('v0/login/chat.u-nesia.com')}}" class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            U-CHAT
                        </a>
                        <a href="{{ url('v0/login/curhat.u-nesia.com')}}" class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            U-CURHAT
                        </a>
                        <a class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            U-HUNGRY
                        </a>
                        <a class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            U-STORE
                        </a>
                    </div>
                    <div class="col-sm-6 col-lg-6 mt-2">
                        <a class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            U-PORTFOLIO
                        </a>
                        <a class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            U-WORK
                        </a>
                        <a class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            BOSQUE
                        </a>
                        <a class="btn btn-block btn-primary" style="padding:20px 0px;" href="#">
                            FOODIES
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
