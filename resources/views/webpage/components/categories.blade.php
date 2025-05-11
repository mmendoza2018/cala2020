    @if (count($categories))
        @foreach ($categories as $category)
            <a class="block overflow-hidden transition card hover:shadow-lg" href="#">
                <img class="rounded-t-md" src="{{ asset('storage/uploads/' . $category->imagen) }}" style="aspect-ratio: 16/16; object-fit: cover; object-position: center">
                <div class="p-3">
                    <h6 class="text-normal text-center">
                        {{ $category->description }}
                    </h6>
                </div>
            </a>
        @endforeach
    @else
        <div class="text-quote mt-xxl-10 mt-xl-8 mt-5 text-center cus-z1 fs-four fw_700 n1-clr position-relative py-xxl-10 py-xl-7 py-5 px-xxl-8 px-xl-7 px-5 aos-init aos-animate current-bg w-full"
            data-aos="zoom-in-left" data-aos-duration="1600">
            No hay Categorias actualmente, intentelo más tarde!
            <span class="icon">
                <i class="ph ph-quotes act3-clr"></i>
            </span>
        </div>
    @endif

    {{--    <div class="txt-right">
        {{ $categories->links('webpage.components.pagination') }}
    </div>
 --}}
