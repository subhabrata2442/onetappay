@extends('layouts.front.frontLayout')

@section('frontContent')
@include('front.templates.header')
<section class="sec-gap-top sec-gap-btm">
  <div class="container-fluid left-right-gap">
    <div class="row">
      <div class="col-12">
        <div class="small-sec-heading">
          <h4>Inspirition for your first Order</h4>
        </div>
        @if(count($category_list)>0)
        <div class="first-order-slider-wrap">
          <div class="owl-carousel owl-theme firstOrderSlider slider-arrow1">
          	@foreach($category_list as $c_row)
            @php
            	$category_image=Helpers::category_image($c_row->photo);
            @endphp
            
            <div class="item">
              <div class="first-order-list"> <span class="first-order-img"> <img src="{{ $category_image }}" alt=""> </span>
                <h4>{{$c_row->category_name}}</h4>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>-
<section class="sec-gap-btm">
  <div class="container-fluid left-right-gap">
    <div class="hotel-list-wrap d-flex">
      <div class="hotel-list-lft">
        <div class="filter-accrodian accordion sticky-bar" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="list1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList1" aria-expanded="true" aria-controls="collapseList1"> Sorte by </button>
            </h2>
            <div id="collapseList1" class="accordion-collapse collapse show" aria-labelledby="list1" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="filter-list-wrap">
                  <ul>
                    <li class="radio">
                      <input type="radio" id="a" name="radio">
                      <label for="a">Most popular</label>
                    </li>
                    <li class="radio">
                      <input type="radio" id="b" name="radio">
                      <label for="b">Rating</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="list2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList2" aria-expanded="false" aria-controls="collapseList2"> Cuisines </button>
            </h2>
            <div id="collapseList2" class="accordion-collapse collapse" aria-labelledby="list2" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="filter-list-wrap">
                  <ul>
                    <li class="checkbox">
                      <input type="checkbox" id="aa" name="">
                      <label for="aa">Most popular</label>
                    </li>
                    <li class="checkbox">
                      <input type="checkbox" id="bb" name="">
                      <label for="bb">Rating</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="list3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList3" aria-expanded="false" aria-controls="collapseList3"> Catagories </button>
            </h2>
            <div id="collapseList3" class="accordion-collapse collapse" aria-labelledby="list3" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="filter-list-wrap">
                  <ul>
                    <li class="radio">
                      <input type="radio" id="aaa" name="radio">
                      <label for="aaa">Most popular</label>
                    </li>
                    <li class="radio">
                      <input type="radio" id="bbb" name="radio">
                      <label for="bbb">Rating</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="list4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList4" aria-expanded="false" aria-controls="collapseList4"> Feature </button>
            </h2>
            <div id="collapseList4" class="accordion-collapse collapse" aria-labelledby="list4" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="filter-list-wrap">
                  <ul>
                    <li class="radio">
                      <input type="radio" id="aaa" name="radio">
                      <label for="aaa">Most popular</label>
                    </li>
                    <li class="radio">
                      <input type="radio" id="bbb" name="radio">
                      <label for="bbb">Rating</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="list5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList5" aria-expanded="false" aria-controls="collapseList5"> Date & Time </button>
            </h2>
            <div id="collapseList5" class="accordion-collapse collapse" aria-labelledby="list5" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="filter-list-wrap">
                  <ul>
                    <li class="radio">
                      <input type="radio" id="aaa" name="radio">
                      <label for="aaa">Most popular</label>
                    </li>
                    <li class="radio">
                      <input type="radio" id="bbb" name="radio">
                      <label for="bbb">Rating</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="list6">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseList6" aria-expanded="false" aria-controls="collapseList6"> Price </button>
            </h2>
            <div id="collapseList6" class="accordion-collapse collapse" aria-labelledby="list6" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="filter-list-wrap">
                  <div class="price-range-slider">
                    <div id="slider-range" class="range-bar"></div>
                    <p class="range-value">
                      <input type="text" id="amount" readonly>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="hotel-list-rgt">
        <div class="row g-2 mb-2 justify-content-between align-items-center">
          <div class="col-auto">
            <div class="small-sec-heading2">
              <h4>Best Resturent Near ME <span class="sm-text">( {{count($store_list)}} Resturent )</span></h4>
            </div>
          </div>
          <div class="col-auto">
            <ul class="grid-btn-wrap d-flex">
              <li>
                <button type="button" class="grid-btn btn-grid active"><i class="fa-solid fa-table-cells"></i></button>
              </li>
              <li>
                <button type="button" class="grid-btn btn-list"><i class="fa-solid fa-list"></i></button>
              </li>
            </ul>
          </div>
        </div>
        <div class="grid-container">
          <div class="row g-4">
          @if(count($store_list)>0)
          	@foreach($store_list as $s_row)
            @php
            	$restaurant_img=Helpers::store_logo($s_row->logo);
            @endphp
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="hotel-box-wrap hover-scle"> <span class="hotel-box-img"> <img class="img-block" src="{{ $restaurant_img }}"> </span>
                <div class="hotel-details">
                  <h4><a href="{{ url('store/'.$s_row->restaurant_slug) }}">{{$s_row->restaurant_name }}</a></h4>
                  <p>{{$s_row->address}}</p>
                  <ul class="product-retting d-flex">
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li><i class="fa-solid fa-star"></i></li>
                    <li>(36 Review)</li>
                  </ul>
                  <p>{{$s_row->delivery_estimation}} min • ${{$s_row->free_delivery}} Delivery Fee</p>
                  <ul class="book-hotel d-flex">
                    <li><a href="{{ url('store/'.$s_row->restaurant_slug) }}">book table</a></li>
                    <li> <a href="{{ url('store/'.$s_row->restaurant_slug) }}"> <span class="btn-img"><img src="{{ asset('public/front/images/serve.png') }}" alt=""></span> order food </a> </li>
                  </ul>
                </div>
              </div>
            </div>
            @endforeach
          @endif
            
            
            
            
            
            <!--<div class="col-12">
              <div class="ads-wrap"> <img class="img-block" src="images/add-banner.png" alt=""> </div>
            </div>-->
            
            
            
            
          </div>
        </div>
        <!--<div class="row justify-content-end">
          <div class="col-auto">
            <div class="pagination-wrap">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span> <span class="sr-only">Previous</span> </a> </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span> <span class="sr-only">Next</span> </a> </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>-->
      </div>
    </div>
  </div>
</section>
@push('scripts') 
<script src="{{ asset('public/front/js/search.js/?t='.time()) }}"></script> 
<script>
$(".firstOrderSlider").owlCarousel({
    loop: false,
    margin: 20,
    stagePadding: 15,
    nav: true,
    dots: false,
    navElement: 'div',
    navText: ["<i class='fa-solid fa-angle-left'></i>", "<i class='fa-solid fa-angle-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 4
        },
        1000: {
            items: 6
        },
        1300: {
            items: 8
        }
    }
});
    	

</script>
@endpush
@endsection