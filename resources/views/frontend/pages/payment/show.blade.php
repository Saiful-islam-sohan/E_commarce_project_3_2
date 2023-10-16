

@extends('frontend.layouts.master')

@section('frontend_content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Code </th>
        <th scope="col">amount</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach ($payment as $pay)
        <th scope="row">{{$loop->index+1}}</th>
        <td>{{$pay->payment_name}}</td>
        <td>{{$pay->payment_amount}}</td>
        @endforeach


      </tr>

    </tbody>
  </table>
  {{-- pagination --}}


@endsection
