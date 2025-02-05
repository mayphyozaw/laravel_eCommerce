@extends('admin.layout.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">

    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.css" rel="stylesheet"> --}}
    <style>
        .select2-selection {
            height: 30px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <a href="{{ route('product.index') }}" class="btn btn-dark" style="margin:15px;">All Products</a>

        <form action="{{ route('product.update', $p->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card ">
                        <div class="card-header">

                            {{-- Product Info --}}
                            <small class="text-muted" style="font-size:14px;">Product Info</small>
                        </div>


                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Enter Product Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $p->name }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Choose Product Image</label>
                                    <input type="file" class="form-control" name="image">

                                    <img src="{{ asset('/images/' . $p->image) }}" style="width:100px" class="img-thumbnail"
                                        alt="">
                                    {{-- {!! $p->description !!} --}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Enter Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ $p->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    {{-- Product Pricing --}}

                    <div class="card ">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Total Quantity</label>
                                    <input type="number" name="total_qty" class="form-control" value="{{ $p->total_qty }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Purchase Price</label>
                                    <input type="number" name="purchase_price" value="{{ $p->purchase_price }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Sales Price</label>
                                    <input type="number" name="sale_price" value="{{ $p->sale_price }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Discount Price</label>
                                    <input type="number" name="discount_price" class="form-control"
                                        value="{{ $p->discount_price }}">
                                </div>
                            </div>
                        </div>
                        {{-- Product Pricing --}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label for="">Choose Supplier</label>
                                    <select name="supplier_slug" class="form-control">
                                        @foreach ($supplier as $s)
                                            <option value="{{ $s->id }}"
                                                @if ($s->id == $p->supplier_id) selected @endif>{{ $s->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Choose Category</label>
                                    <select name="category_slug" class="form-control">
                                        @foreach ($category as $c)
                                            <option value="{{ $c->slug }}"
                                                @if ($c->id == $p->category_id) selected @endif>
                                                {{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Choose Brand</label>
                                    <select name="brand_slug" class="form-control">
                                        @foreach ($brand as $b)
                                            <option value="{{ $b->slug }}"
                                                @if ($b->id == $p->brand_id) selected @endif>
                                                {{ $b->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Choose Color</label>
                                    <select name="color_slug[]" multiple class="form-control">
                                        @foreach ($color as $col)
                                            <option value="{{ $col->slug }}"
                                                @foreach ($p->color as $p_c)
                                                    @if ($p_c->id == $col->id)
                                                        selected
                                                    @endif @endforeach>
                                                {{ $col->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" value="Update" class="btn btn-sm btn-primary form-control border-0">
                            </div>
                        </div>

                    </div>

                </div>


            </div>

        </form>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.js"></script>
    <script>
        $(function() {
            $('#supplier').select2();
            $('#category').select2();
            $('#brand').select2();
            $('#color').select2();

            $('#description').summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        var frmData = new FormData();
                        frmData.append('image', files[0]);
                        frmData.append('_token', "@php echo csrf_token(); @endphp")

                        $.ajax({ // to send server with file
                            method: 'POST',
                            url: '/admin/product-upload',
                            contentType: false, //JQuery Default contentType Option
                            processData: false, //JQuery Default processData option
                            data: frmData,
                            success: function(data) {
                                $('#description').summernote('insertImage', data);
                            }

                        })
                    }
                }
            });
        });
    </script>
@endsection
