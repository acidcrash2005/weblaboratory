{{--<div class="courses b-scroll-block">--}}
    {{--<div class="container">--}}
        {{--<h2>Онлайн курсы</h2>--}}
        {{--<!-- Swiper -->--}}
        {{--<div class="slider-block">--}}
            {{--<div class="swiper-container">--}}
                {{--<div class="swiper-wrapper">--}}
                    {{--@foreach($courses as $course)--}}
                        {{--<div class="swiper-slide">--}}
                            {{--<a href="{{ url('/course') }}/{{$course->id}}"><img src="/img/{{$course->image}}?h=200&w=353" alt=""></a>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--</div>--}}

                {{--<!-- Add Arrows -->--}}
                {{--<div class="swiper-button-next"></div>--}}
                {{--<div class="swiper-button-prev"></div>--}}

            {{--</div>--}}

            {{--<!-- Add Pagination -->--}}
            {{--<div class="swiper-pagination"></div>--}}
        {{--</div>--}}


        {{--<!-- Initialize Swiper -->--}}
        {{--<script>--}}
            {{--$(function () {--}}
                {{--var swiper = new Swiper('.courses .swiper-container', {--}}
                    {{--pagination: '.courses .swiper-pagination',--}}
                    {{--slidesPerView: 3,--}}
                    {{--paginationClickable: true,--}}
                    {{--nextButton: '.courses .swiper-button-next',--}}
                    {{--prevButton: '.courses .swiper-button-prev',--}}
                    {{--spaceBetween: 30,--}}
                    {{--loop: true--}}
                {{--});--}}
            {{--})--}}
        {{--</script>--}}


    {{--</div>--}}
{{--</div>--}}

<div class="products b-scroll-block">
    <div class="container">
        <h2>Продукты</h2>
        <!-- Swiper -->
        <div class="slider-block">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($products as $product)
                        <div class="swiper-slide">
                            <a href="{{ url('/product') }}/{{$product->id}}">{{$product->title}}</a>
                        </div>
                    @endforeach
                </div>

                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>

            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>


    <!-- Initialize Swiper -->
        <script>
            $(function () {
                var swiper = new Swiper('.products .swiper-container', {
                    pagination: '.products .swiper-pagination',
                    slidesPerView: 3,
                    paginationClickable: true,
                    nextButton: '.products .swiper-button-next',
                    prevButton: '.products .swiper-button-prev',
                    spaceBetween: 30,
                    loop: true
                });
            })
        </script>


    </div>
</div>

