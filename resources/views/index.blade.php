@extends('layouts.home')
@section('title') Blood Bank @endsection
@section('content')

    @include('frontend.inc.slider')
    @include('frontend.inc.about')
    @include('frontend.inc.articles',array('posts'=>$posts))
    @include('frontend.inc.requests')
    @include('frontend.inc.contact',['settings' => $settings = App\Models\AppSetting::find(1)])
   
@endsection
