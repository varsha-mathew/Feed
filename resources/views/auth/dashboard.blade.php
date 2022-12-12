@extends('auth.feed_layout')
@section('content')
@if(session()->has('message'))
    <div class="alert alert-dismissable alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('message') }}
    </div>
@endif


    <!-- Events Start -->
    <section class="white-paddings">
        <div class="container">
            <div class="row">
            <div class="col-12">
                    <div class="common-heading text-center">
                        <h4>Welcome {{Auth::user()->name}}</h4>
                    </div>
                </div>

                <div class="row toprow">
                <div class="col-12">
                <form method="POST" action="{{ route('save_feed') }}">
                @csrf
                    <span class="required-field">Type/Paste a feed url to save to your personal list</span>
                    <input type="text" class="feedtext" name="feed" id="feed" required>
                    @if ($errors->has('feed'))
                                <span class="text-danger">{{ $errors->first('feed') }}</span>
                                @endif
                                <button class="addittineryBtn float-right" type="submit">Save</button> 
                </form>
                </div>

               
                
            </div>
         
            </div>
        </div>
    </section>
      
      

@endsection