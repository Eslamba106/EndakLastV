@extends('layouts.home')
@section('title')
    <?php $lang = config('app.locale'); ?>
    {{ ($lang == 'ar') ? 'خدمة' : 'Order' }}
@endsection

@section('content')
    <?php
    $lang = config('app.locale');
    ?>
    <div class="main-content app-content">
        <section>
            <div class="section banner-4 banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center">
                            <div class="">
                                <p class="mb-3 content-1 h5 fs-1 " style="color: black">{{ ($lang == 'ar') ? 'خدمة' : 'Order' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <section class="profile-cover-container mb-2">

        <div class="profile-content pt-40">
            <div class="container position-relative d-flex justify-content-center ">
                <?php $user = auth()->user(); ?>
                <div style="width:600px" class="profile-card rounded-lg shadow-xs bg-white p-15 p-md-30">

                        <div class="form-group mt-2">
                            @foreach ($service->images as $item)
                                <img width="80px" height="80px" src="{{ asset('storage/' . $item->path) }}" alt="">
                            @endforeach
    
                        </div>
                        <hr>
    
                        <div class="form-group">
                            <label for=""
                                class="mb-1">{{ $lang == 'ar' ? 'ملاحظة عن العمل المطلوب' : 'Note About Work' }}
                                :</label>
                            @if (isset($service->notes))
                                <p>{{ $service->notes }}</p>
                            @else
                                {{ $lang == 'ar' ? 'لا يوجد ملاحظات' : 'No Notes' }}
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-1">{{ $lang == 'ar' ? 'صاحب العمل' : 'Customer' }}
                                :</label>
                            <span class="">{{ $service->user->full_name }} </span>
                            @if (isset($service->user->image))
                                <img width="250px" height="250px" src="{{ asset($service->user->image_url) }}" alt="user">
                            @endif
                        </div>

                    <hr>
                    <div class="form-group">
                        <label for=""
                            class="mb-1">{{ ($lang == 'ar') ? 'ملاحظة عن العمل المطلوب' : 'Note About Work' }}
                            :</label>
                        @if (isset($service->notes))
                            <p>{{ $service->notes }}</p>
                        @else
                            {{ ($lang == 'ar') ? 'لا يوجد ملاحظات' : 'No Notes' }}
                        @endif
                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>
    <?php $offer = $service->comments->where('service_provider', $order->service_provider_id)->first();
            $rating_counter_insects = App\Models\Rating::where('order_id' , $order->id)->where('department_name' , 'counter_insects')->first(); 
    ?>
    <section class="section d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card">


                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="border mb-4 p-4 br-5" style="flex: 1 1 calc(33.333% - 1rem); margin: 0.5rem;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mt-0 mr-3">
                                        {{ $offer->user->first_name . ' ' . $offer->user->last_name }}
                                    </h5>
                                    <div>
                                        @if ($user->id == $order->customer_id)
                                            @if ($order->status == 'pending')
                                                <a href="{{ route('accept_project_counter_insects', $order->id) }}"
                                                    class="btn btn-primary">{{ ($lang == 'ar') ? 'أستلام المشروع' : 'Confirm Project' }}</a>
                                            @elseif($order->status == 'completed' && !$rating_counter_insects)
                                                <a href="{{ route('web.add_rate', $order->id) }}"
                                                    class="btn btn-primary">{{ ($lang == 'ar') ? 'تقييم العمل' : 'Rate Work' }}</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                @if (isset($offer->price))
                                    <p>{{ __('general.price') . ' : ' . $offer->price }}</p>
                                @endif
                                @if (isset($offer->body))
                                    <p>{{ 'Body : ' . $offer->body }}</p>
                                @endif
                                @if (isset($offer->date))
                                    <p>{{ __('general.date') . ' : ' . $offer->date }}</p>
                                @endif
                                @if (isset($offer->time))
                                    <p>{{ __('general.time') . ' : ' . $offer->time }}</p>
                                @endif
                                @if (isset($offer->city))
                                    <p>{{ (($lang == 'ar') ? 'المدينة' : 'City') . ' : ' . $offer->city }}
                                    </p>
                                @endif
                                @if (isset($offer->neighborhood))
                                    <p>{{ (($lang == 'ar') ? 'الحي' : 'Neighborhood') . ' : ' . $offer->neighborhood }}
                                    </p>
                                @endif
                                @if (isset($offer->location))
                                    <p>{{ (($lang == 'ar') ? 'الموقع' : 'Location') . ' : ' . $offer->location }}
                                    </p>
                                @endif
                                @if (isset($offer->day))
                                    <p>{{ __('general.day') . ' : ' . $offer->day }}</p>
                                @endif
                                @if (isset($offer->number_of_days_of_warranty))
                                    <p>{{ (($lang == 'ar') ? 'عدد ايام الضمان' : 'Number of Days of Warranty') . ' : ' . $offer->number_of_days_of_warranty }}
                                    </p>
                                @endif
                                @if (isset($offer->notes))
                                    <p>{{ (($lang == 'ar') ? 'ملاحظات عن العمل المطلوب' : 'Notes') . ' : ' . $offer->notes }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>






        </div>

    </section>
@endsection