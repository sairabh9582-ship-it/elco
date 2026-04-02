@extends('layouts.admin')

@section('content')
<div class="container-fluid content-inner pb-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Add Category</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="name">Category Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <!-- Mock Product Count (Optional) - Can be removed if not needed -->
                             <div class="col-md-6 mb-3">
                                <label class="form-label" for="product_count_mock">Initial Count Display (Optional)</label>
                                <input type="number" class="form-control" id="product_count_mock" name="product_count_mock" value="0">
                            </div>
                            </div>
                        </div>

                        <hr>
                        <h5>SEO Settings</h5>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Comma separated keywords">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
