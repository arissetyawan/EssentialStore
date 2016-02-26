@extends('manage')
@section('content')
  <div class="container">
    <form action={{ url('createCategory') }} method = "POST" enctype="multipart/form-data">
      {{ csrf_field() }}
          <div class="form-group">
            <label for="category-name" class="control-label">Category name</label>
            <input type="text" class="form-control" id="category-name" name="category_name">
          </div>
          <div class="form-group">
            <label for="category-description" class="control-label">Category description</label>
            <textarea class="form-control" id="cateogry-description" name = "category_description"></textarea>
          </div>
          
          <div class="form-group">
            <button type= "submit" class= "btn btn-lg btn-primary">Create</button>
          </div>
        </form>
  </div>
@stop