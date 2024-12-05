@extends('layouts.webpage.master')

@section('content')
    <div>
        <section class="relative pb-28 xl:pb-36 pt-44 xl:pt-52" id="home">
            <div class="absolute top-0 left-0 size-64 bg-custom-500 opacity-10 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 size-64 bg-purple-500/10 blur-3xl"></div>
            <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <div class="grid items-center grid-cols-12 gap-5 2xl:grid-cols-12">
                    <div class="col-span-12 xl:col-span-5 2xl:col-span-5">
                        <h1 class="mb-4 !leading-normal lg:text-5xl 2xl:text-6xl dark:text-zinc-100 aos-init aos-animate"
                            data-aos="fade-right" data-aos-delay="300">Exclusive Collections 2024</h1>
                        <p class="text-lg mb-7 text-slate-500 dark:text-zinc-400 aos-init aos-animate" data-aos="fade-right"
                            data-aos-delay="600">In 2024, metallics will be taking over the sneaker world. I love this trend
                            because there are so many different ways to wear it. You can wear sequined sneakers, white
                            sneakers with metallic accents, or all-over silver.</p>
                        <div class="flex items-center gap-2 aos-init aos-animate" data-aos="fade-right"
                            data-aos-delay="800">
                            <button type="button"
                                class="px-8 py-3 text-white border-0 text-15 btn bg-gradient-to-r from-custom-500 to-purple-500 hover:text-white hover:from-purple-500 hover:to-custom-500">Shop
                                Now <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" data-lucide="shopping-cart"
                                    class="lucide lucide-shopping-cart inline-block align-middle size-4 rtl:mr-1 ltr:ml-1">
                                    <circle cx="8" cy="21" r="1"></circle>
                                    <circle cx="19" cy="21" r="1"></circle>
                                    <path
                                        d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12">
                                    </path>
                                </svg></button>
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-7 2xl:col-start-8 2xl:col-span-6">
                        <div class="relative mt-10 xl:mt-0">
                            <div class="absolute text-center -top-20 xl:-right-40 lg:text-[10rem] 2xl:text-[14rem] text-slate-100 dark:text-zinc-800/60 font-tourney aos-init aos-animate"
                                data-aos="zoom-in-down" data-aos-delay="1400">
                                Unique Fashion
                            </div>
                            <img src="assets/images/offer.png" alt=""
                                class="absolute h-40 left-10 xl:-left-10 top-32 aos-init aos-animate"
                                data-aos="fade-down-right" data-aos-delay="900" data-aos-easing="linear">
                            <div class="relative aos-init aos-animate" data-aos="zoom-in" data-aos-delay="500">
                                <button data-tooltip="default" data-tooltip-content="$199.99"
                                    class="absolute items-center justify-center hidden bg-white rounded-full size-8 xl:flex bottom-20 text-slate-800 left-20"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg></button>
                                <img src="assets/images/product-home.png" alt="" class="mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/home.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
