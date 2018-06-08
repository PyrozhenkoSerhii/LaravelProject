@extends('adminPage/adminPageMain')
@section('contentSecond')
    <div class="container">
        <div class="row">
                <div class="panel panel-default">
                    <div>
                        <h2><p style="font-weight: bold;" align="center">Info about users</p></h2>
                            <hr>

                        <div class="container" style="width: 100%;">
                            <div style="width: 4%; float:left;">
                                <h4><p style="font-weight: bold;">Id</p></h4>
                            </div>
                            <div style="width: 38%; float:left;">
                                <h4><p style="font-weight: bold;">Name</p></h4>
                            </div>
                            <div style="width: 48%; float:left;">
                                <h4> <p style="font-weight: bold;">Email</p></h4>
                            </div>
                            <div style="width: 10%; float:right;">
                                <h4><p style="font-weight: bold;">Access</p></h4>
                            </div>

                        </div>

                            @foreach($users as $user)
                                <div class="container" style="width: 100%; ">
                                    <div style="width: 4%; float:left;">
                                        <h5>{{$user->id}}</h5>
                                    </div>
                                    <div style="width: 38%;  float:left;">
                                        <h5>{{$user->name}}</h5>
                                    </div>
                                    <div style="width: 48%;  float:left;">
                                        <h5>{{$user->email}}</h5>
                                    </div>

                                    @if(Auth::user()->id != $user->id)
                                        @if($user->isAdmin==0)
                                            <div style="width: 10%; float:right;">
                                                <h5 align="left"> <p><a href="{{ route('changeAccess',['id'=>$user->id])}}" style="color: limegreen" >DoAdmin</a></p></h5>
                                            </div>
                                        @endif
                                        @if($user->isAdmin==1)
                                            <div style="width: 10%; float:right;">
                                                <h5 align="left"> <p><a href="{{ route('changeAccess',['id'=>$user->id])}}" style="color: red" >DoUser</a></p></h5>
                                            </div>
                                        @endif
                                    @else
                                        <div style="width: 10%;float:right;">
                                            <h5 style="color: blue">You</h5>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop