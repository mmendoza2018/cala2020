@extends('layouts.webpage.master')

@section('content')
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto" style="margin-top: 100px; background-color: #f9fafb; min-height: 90vh">
        <div>
            <h5 class="title-page mb-16">Categorias</h5>
        </div>
        <div class="grid grid-cols-2 mt-5 md:grid-cols-2 [&.gridView]:grid-cols-1 xl:grid-cols-4 group [&.gridView]:xl:grid-cols-1 gap-x-5"
            id="cardGridView">
            @include('webpage.components.categories', ['categories' => $categories])
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
