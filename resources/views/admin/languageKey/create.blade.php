@extends('admin.layouts.dashboard')
@section('title')
{{__('Language')}}
@endsection
@section('languagemenu')
active show-sub
@endsection
@section('languageKeycreate')
active
@endsection
@section('css')
    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style> button{ cursor: pointer; } </style>
@endsection
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">{{__(App\Models\SiteSetting::first()->value('name')??'')}}</a>
    <span class="breadcrumb-item active">{{__('Language')}}</span>
</nav>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <!-- <h5>language Key Create</h5>
      <p>Create language key with required field.</p> -->
    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
        <div class="row">
            <div class="col-7">
                <h6 class="card-body-title">{{ __('Language Key Tanslate Form') }}</h6>
                <p class="mg-b-20 mg-sm-b-30">{{ __('You may translate all key with all required field.') }}</p>
            </div>
            <div class="col-5 text-right">
                <a class="btn btn-info" href="{{ route('admin.language.index') }}">{{ __('View All') }}</a>
            </div>
        </div>

        @include('partials.message')
        @if(request('locale') === null)
        <form action="" method="GET">
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Select Language') }}: <span class="tx-danger"></span></label>
                            <select class="form-control form-select search-select" aria-label="Default select example" name="locale">
                                @foreach($languages as $data)
                                <option value="{{ $data->key??'' }}" @if(app()->getLocale()==$data->key) selected @endif >{{ __($data->name??'') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-6 -->
                <div class="form-layout-footer mt-4">
                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </form>

        @else
        <form action="{{route('admin.languageKey.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="locale" value="{{ request('locale') }}" />
            <div class="form-layout">
                <div class="row mg-b-25">
                @foreach($keys as $key)
                @if($key->keyword == 'validation.custom') @continue @endif
                <div class="col-md-1">{{$loop->iteration}}</div>
                <div class=" col-md-5">
                    {{ $key->keyword }}
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" name="values[{{ $key->keyword }}]" value="{{ __($key->keyword, [], request('locale')) }}"></input>
                    </div>
                </div><!-- col-6 -->
                @endforeach
                <div class="form-layout-footer">
                    <button class="btn btn-info mg-r-5" type="submit">{{ __('Submit') }}</button>
                </div><!-- form-layout-footer -->
                </div><!-- row -->
            </div>
        </form>
        @endif

    </div><!-- card -->




  </div><!-- sl-pagebody -->

@endsection

@section('js')
<script src="{{ asset('backend/lib/datatables/jquery.dataTables.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

@endsection


