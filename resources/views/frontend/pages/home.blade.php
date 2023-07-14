

@extends('frontend.layouts.master')

{{-- @include('frontend.pages.widgets.navbar') --}}


@section('frontend_content')
<main class="main">
    @include('frontend.pages.widgets.slidbar')

   @include('frontend.pages.widgets.featured')

    @include('frontend.pages.widgets.main_product')
    @include('frontend.pages.widgets.learn_more')
    @include('frontend.pages.widgets.populer_category')
    @include('frontend.pages.widgets.offers')
   @include('frontend.pages.widgets.arrivales')

   @include('frontend.pages.widgets.brand')

</main>


@endsection




