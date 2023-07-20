@extends('Admin.layouts.master')
@section('page_title')
    Create Page
@endsection
@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('admin_content')
<div class="row">
    <h1>Category Create Form</h1>
    <div class="col-12">
        <div class="d-flex justify-content-start">
            <a href="{{route('categories.index')}}" class="btn btn-primary">
                <i class="fas fa-backward"></i>
                Back to Categories
            </a>
        </div>
    </div>
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{route('categories.store')}}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="category-title" class="form-label">Category Title</label>
                    <input type="text" name="title" class="form-control @error('title')
                        is-invalid
                    @enderror" placeholder="enter category title" id="">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <div class="mb-3 form-check form-switch">
                    <input class="form-check-input" name="is_active" type="checkbox" role="switch" id="activeStatus" checked>
                    <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-success">Store</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
