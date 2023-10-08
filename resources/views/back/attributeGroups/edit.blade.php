@extends('back.layouts.master')

@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb no-border">
                                <li class="breadcrumb-item">مدیریت
                                </li>
                                <li class="breadcrumb-item">مدیریت ویژگی ها
                                </li>
                                <li class="breadcrumb-item active">ویرایش گروه ویژگی
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body">
            <!-- Description -->
            <section class="card">
                <div class="card-header">
                    <h4 class="card-title">ویرایش گروه ویژگی </h4>
                </div>
                
                <div id="main-card" class="card-content">
                    <div class="card-body">
                        <div class="col-12 col-md-10 offset-md-1">
                            <form class="form" id="attributeGroup-edit-form" action="{{ route('admin.attributeGroups.update', ['attributeGroup' => $attributeGroup]) }}">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>نام</label>
                                                <input type="text" class="form-control" name="name" value="{{ $attributeGroup->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>نوع گروه</label>
                                                <select name="type" class="form-control">
                                                    <option value="checkbox" {{ $attributeGroup->type == 'checkbox' ? 'selected' : '' }}>دکمه</option>
                                                    <option value="color" {{ $attributeGroup->type == 'color' ? 'selected' : '' }}>رنگ</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <button type="submit" class="btn btn-primary mb-1 waves-effect waves-light">ویرایش ویژگی</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Description -->
            
        </div>
    </div>
</div>

@endsection

@push('scripts') 
    <script src="{{ asset('back/app-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('back/app-assets/plugins/jquery-validation/localization/messages_fa.min.js') }}"></script>

    <script src="{{ asset('back/assets/js/pages/attributeGroups/edit.js') }}"></script>
@endpush