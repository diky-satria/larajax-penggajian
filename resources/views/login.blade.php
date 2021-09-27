@extends('templates/template')

@section('konten')
   <div class="row">
      <div class="col-lg-8 log-kiri">
         <img src="{{ asset('assets/img/login-web.png') }}">
      </div>
      <div class="col-lg-4 log-kanan">
         <div class="row">
            <div class="col d-flex justify-content-center">
               <div class="con-login-logo">
                  <img class="img-login-logo" src="{{ asset('assets/img/logo-login.png') }}">
               </div>
            </div>
         </div>
         @if($gagal = session()->get('message'))
         <div class="alert alert-danger log-alert">
            {{ $gagal }}
         </div>
         @endif
         @if($logout = session()->get('logout'))
         <div class="alert alert-success log-alert">
            {{ $logout }}
         </div>
         @endif
         <form action="{{ url('login') }}" method="post">
            @csrf
            <div class="form-group">
               <input type="text" name="email" class="form-control log-form-control" placeholder="Email...">
               @error('email')
               <div class="form-text text-danger">
                  {{ $message }}
               </div>
               @enderror
            </div>
            <div class="form-group">
               <input type="password" name="password" class="form-control log-form-control mt-4" placeholder="Password">
               @error('password')
               <div class="form-text text-danger">
                  {{ $message }}
               </div>
               @enderror
            </div>
            <div class="con-log-btn">
               <button type="submit" class="btn btn-sm btn-primary btn-block log-btn">Login</button>
            </div>
         </form>
      </div>
   </div>
@endsection