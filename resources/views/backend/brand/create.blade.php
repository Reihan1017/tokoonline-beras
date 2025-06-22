@extends('backend.layouts.master')
@section('title','Tambah Merek')
@section('main-content')

<div class="card">
    <h5 class="card-header">Tambah Merek</h5>
    <div class="card-body">
      <form method="post" action="{{route('brand.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Nama Merek <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Masukkan nama merek" value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Aktif</option>
              <option value="inactive">Tidak Aktif</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Atur Ulang</button>
          <button class="btn btn-success" type="submit">Kirim</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Tulis deskripsi singkat...",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
