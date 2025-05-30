@extends('layouts.services')
@section('title')
    {{ __('general.home') }}
    <?php $lang = config('app.locale'); ?>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('css/css-stars.css') }}">
    <style>
        .stars-card {
            min-height: 20px;
        }

        .stars-card svg {
            margin-right: 3px;
            color: #818894;
        }

        .stars-card svg.active {
            color: #ffc600;
            fill: #ffc600;
        }

        .stars-card i.active svg {
            color: #ffc600;
            fill: #ffc600;
        }

        .myform {
            max-width: 500px;
            margin: 0 auto;
        }

        .input-group {
            width: 100%;
        }

        .form-control {
            height: 60px;
            font-size: 1.2rem;
            padding: 15px;
            border-radius: 5px 0 0 5px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            height: 60px;
            font-size: 1.2rem;
            border-radius: 0 5px 5px 0;
        }

        .card-custom {
            width: 100%;
            height: 200px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: rgba(169, 169, 169, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-custom img {
            width: 80%;
            height: auto;
            object-fit: contain;
            max-height: 150px;
        }

        .card-custom .card-body {
            text-align: center;
            padding: 10px;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endsection
@section('content')
    <?php
    $minutes = 60;
    $settings = Illuminate\Support\Facades\Cache::remember('settings', $minutes, function () {
        return App\Models\Settings::first();
    });
    // $departments = Illuminate\Support\Facades\Cache::remember('departments', $minutes, function () {
    //     return App\Models\Department::where('department_id', 0)->get();
    // });
    $posts_count = Illuminate\Support\Facades\Cache::remember('posts_count', $minutes, function () {
        return App\Models\Post::count();
    });
    $order_count = Illuminate\Support\Facades\Cache::remember('order_count', $minutes, function () {
        return App\Models\Order::count();
    });
    $user = auth()->user();
    // $userDepartments = $user->departments()->with('commentable')->get();
    // $contracting = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Contracting::class;
    // });
    // if(isset($user->departments)){

    //     $userDepartments = $user->departments()->with('commentable')->get();
    //     // $contracting = $userDepartments->first(function ($department) {
    //     //     if($department->commentable_type === \App\Models\Contracting::class){
    //     //         return  \App\Models\Contracting::where('id' , $department->commentable_id)->first();
    //     //     }
    //     //     return false;
    //     // });

    // $main_contracting = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Contracting::class;
    // });
    // $contracting = null;
    // if($main_contracting){

    //     $contracting =  \App\Models\Contracting::where('id' , $main_contracting->commentable_id)->first();
    // }

    // $main_maintenance = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Maintenance::class;
    // });
    // $maintenance = null;
    // if($main_maintenance ){

    //     $maintenance =  \App\Models\Maintenance::where('id' , $main_maintenance->commentable_id)->first();
    // }
    // $Follow_cameras = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\FollowCamera::class;
    // });
    // $furniture_transportations = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\FurnitureTransportation::class;
    // });
    // $PartyPreparation = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\PartyPreparation::class;
    // });
    // $counter_insects = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\CounterInsects::class;
    // });
    // $cleaning = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Cleaning::class;
    // });
    // $teacher = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Teacher::class;
    // });
    // $family = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Family::class;
    // });
    // $worker = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Worker::class;
    // });
    // $general_service = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\PublicGe::class;
    // });
    // $ads = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Ads::class;
    // });
    // $water = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Water::class;
    // });
    // $car_water = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\CarWater::class;
    // });
    // $big_car = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\BigCar::class;
    // });
    // $garden = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\Garden::class;
    // });
    // $heavy_equip = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\HeavyEquipment::class;
    // });
    // $spare_part = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\SpareParts::class;
    // });
    // $air_con = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\AirCondition::class;
    // });
    // $van_truck = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\VanTruck::class;
    // });
    // $industry = $userDepartments->first(function ($department) {
    //     return $department->commentable_type === \App\Models\industries::class;
    // });
// }else{
    $Follow_cameras =  \App\Models\FollowCamera::first();
    $furniture_transportations =  \App\Models\FurnitureTransportation::first();
    $PartyPreparation =   \App\Models\PartyPreparation::first();
    $counter_insects = \App\Models\CounterInsects::first();
    $cleaning = \App\Models\Cleaning::first();
    $teacher = \App\Models\Teacher::first();
    $family = \App\Models\Family::first();
    $worker = \App\Models\Worker::first();
    $general_service = \App\Models\PublicGe::first();
    $ads = \App\Models\Ads::first();
    $water = \App\Models\Water::first();
    $car_water = \App\Models\CarWater::first();
    $big_car = \App\Models\BigCar::first();
    $garden = \App\Models\Garden::first();
    $contracting =   \App\Models\Contracting::first();
    $maintenance =   \App\Models\Maintenance::first();
    $heavy_equip = \App\Models\HeavyEquipment::first();
    $spare_part = \App\Models\SpareParts::first();
    $air_con = \App\Models\AirCondition::first();
    $van_truck = \App\Models\VanTruck::first();
    $industry = \App\Models\industries::first();

// }


    $users_count = App\Models\User::count();
    $providers_count = App\Models\User::where('role_id', operator: 3)->count();
    $users = App\Models\User::where('role_id', 3)->limit(6)->get();
    // dd(auth()->user()->departments()->with('commentable')->get());

    // dd($userDepartments)
    ?>


    <section class="section overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="heading-section">
                    <div class="heading-subtitle">
                        <span class="tx-primary tx-16 fw-semibold"
                            style="color: black;">{{ __('department.departments') }}</span>
                    </div>
                </div>

                <div class="cards-container">
                    @if ($furniture_transportations)
                        <div class="card card-custom">
                            @if ($furniture_transportations->image)
                                <a href="{{ route('furniture_transportations_service') }}">
                                    <img src="{{ $furniture_transportations->image_url }}" class="card-img-top"
                                        alt="{{ $furniture_transportations->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('furniture_transportations_service') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $furniture_transportations->name_ar : $furniture_transportations->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($car_water)
                        <div class="card card-custom">
                            @if ($car_water->image)
                                <a href="{{ route('car_water_show') }}">
                                    <img src="{{ $car_water->image_url }}" class="card-img-top"
                                        alt="{{ $car_water->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('car_water_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $car_water->name_ar : $car_water->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($industry)
                        <div class="card card-custom">

                            <div class="card-body">
                                <a href="{{ route('indsproducts.products') }}">
                                    <p class="card-text">{{ $industry->name }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif



                    @if ($big_car)
                        <div class="card card-custom">
                            @if ($big_car->image)
                                <a href="{{ route('big_car_show') }}">
                                    <img src="{{ $big_car->image_url }}" class="card-img-top"
                                        alt="{{ $big_car->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('big_car_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $big_car->name_ar : $big_car->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($family)
                        <div class="card card-custom">
                            @if ($family->image)
                                <a href="{{ route('family_show') }}">
                                    <img src="{{ $family->image_url }}" class="card-img-top" alt="{{ $family->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('family_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $family->name_ar : $family->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($cleaning)
                        <div class="card card-custom">
                            @if ($cleaning->image)
                                <a href="{{ route('cleaning_show') }}">
                                    <img src="{{ $cleaning->image_url }}" class="card-img-top"
                                        alt="{{ $cleaning->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('cleaning_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $cleaning->name_ar : $cleaning->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($teacher)
                        <div class="card card-custom">
                            @if ($teacher->image)
                                <a href="{{ route('teacher_show') }}">
                                    <img src="{{ $teacher->image_url }}" class="card-img-top"
                                        alt="{{ $teacher->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('teacher_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $teacher->name_ar : $teacher->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if ($Follow_cameras)
                        <div class="card card-custom">
                            @if ($Follow_cameras->image)
                                <a href="{{ route('surveillance_cameras_show') }}">
                                    <img src="{{ $Follow_cameras->image_url }}" class="card-img-top"
                                        alt="{{ $Follow_cameras->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('surveillance_cameras_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $Follow_cameras->name_ar : $Follow_cameras->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($PartyPreparation)
                        <div class="card card-custom">
                            @if ($PartyPreparation->image)
                                <a href="{{ route('party_preparation_show') }}">
                                    <img src="{{ $PartyPreparation->image_url }}" class="card-img-top"
                                        alt="{{ $PartyPreparation->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('party_preparation_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $PartyPreparation->name_ar : $PartyPreparation->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($garden)
                        <div class="card card-custom">
                            @if ($garden->image)
                                <a href="{{ route('garden_show') }}">
                                    <img src="{{ $garden->image_url }}" class="card-img-top" alt="{{ $garden->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('garden_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $garden->name_ar : $garden->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($worker)
                        <div class="card card-custom">
                            @if ($worker->image)
                                <a href="{{ route('worker_show') }}">
                                    <img src="{{ $worker->image_url }}" class="card-img-top" alt="{{ $worker->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('worker_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $worker->name_ar : $worker->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif


                    @if ($general_service)
                        <div class="card card-custom">
                            @if ($general_service->image)
                                <a href="{{ route('public_ge_show') }}">
                                    <img src="{{ $general_service->image_url }}" class="card-img-top"
                                        alt="{{ $general_service->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('public_ge_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $general_service->name_ar : $general_service->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($counter_insects)
                        <div class="card card-custom">
                            @if ($counter_insects->image)
                                <a href="{{ route('counter_insects_show') }}">
                                    <img src="{{ $counter_insects->image_url }}" class="card-img-top"
                                        alt="{{ $counter_insects->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('counter_insects_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $counter_insects->name_ar : $counter_insects->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($ads)
                        <div class="card card-custom">
                            @if ($ads->image)
                                <a href="{{ route('ads_show') }}">
                                    <img src="{{ $ads->image_url }}" class="card-img-top" alt="{{ $ads->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('ads_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $ads->name_ar : $ads->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif


                    @if ($water)
                        <div class="card card-custom">
                            @if ($water->image)
                                <a href="{{ route('water_show') }}">
                                    <img src="{{ $water->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $water->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('water_show') }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $water->name_ar : $water->name_en }}</p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($contracting)
                        <div class="card card-custom">
                            @if ($contracting->image)
                                <a href="{{ route('contracting_show') }}">
                                    <img src="{{ $contracting->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $contracting->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('contracting_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $contracting->name_ar : $contracting->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($maintenance)
                        <div class="card card-custom">
                            @if ($maintenance->image)
                                <a href="{{ route('maintenance_show') }}">
                                    <img src="{{ $maintenance->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $maintenance->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('maintenance_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $maintenance->name_ar : $maintenance->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($heavy_equip)
                        <div class="card card-custom">
                            @if ($heavy_equip->image)
                                <a href="{{ route('heavy_equip_show') }}">
                                    <img src="{{ $heavy_equip->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $heavy_equip->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('heavy_equip_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $heavy_equip->name_ar : $heavy_equip->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($spare_part)
                        <div class="card card-custom">
                            @if ($spare_part->image)
                                <a href="{{ route('spare_part_show') }}">
                                    <img src="{{ $spare_part->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $spare_part->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('spare_part_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $spare_part->name_ar : $spare_part->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($air_con)
                        <div class="card card-custom">
                            @if ($air_con->image)
                                <a href="{{ route('air_con_show') }}">
                                    <img src="{{ $air_con->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $air_con->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('air_con_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $air_con->name_ar : $air_con->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($van_truck)
                        <div class="card card-custom">
                            @if ($van_truck->image)
                                <a href="{{ route('van_truck_show') }}">
                                    <img src="{{ $van_truck->image_url }}" class="card-img-top mt-2"
                                        alt="{{ $van_truck->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('van_truck_show') }}">
                                    <p class="card-text">
                                        {{ $lang == 'ar' ? $van_truck->name_ar : $van_truck->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- @forelse ($userDepartments as $department)
                    @php
                        // $modelRouteName = strtolower(class_basename($department->commentable_type)) . '_show';
                        $modelBaseName = strtolower(Str::snake(class_basename($department->commentable_type))); // 'big_car'
                        $modelRouteName = $modelBaseName . '_show'; // 'big_car_show'
                    @endphp
                    {{-- dd($department) --}}
                        {{-- <div class="card card-custom">
                            @if ($department->commentable->image)
                                <a href="{{ route($modelRouteName) }}">
                                    <img src="{{ $department->commentable->image_url }}" class="card-img-top"
                                        alt="{{ $department->commentable->name_ar }}">
                                </a>
                            @endif
                            <div class="card-body">
                                <a href="{{ route($modelRouteName) }}">
                                    <p class="card-text">{{ $lang == 'ar' ? $department->commentable->name_ar : $department->commentable->name_en }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @empty
                    @endforelse --}}

                </div>




            </div>
        </div>
    </section>


    <section class="section bg-pattern-2 bg-image2" style="background-color: #007bff">
        <div class="container"  style="background-color: #007bff">
            <div class="heading-section">
                <div class="heading-title " style="color: black;">{{ __('general.why') }}</div>
                <div class="heading-description text-white op-8">
                </div>
            </div>
            <div class="row align-items-center">
                <?php ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card text-center feature-card-16 mb-lg-0">
                        <div class="card-body">
                            <svg class="feature-icon br-style1 primary mb-3" xmlns="http://www.w3.org/2000/svg"
                                height="60" width="60" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path fill="#729af0"
                                    d="M15 20.5H7c-1.7 0-3-1.3-3-3v-5.3c0-.6.4-1 1-1h12c.6 0 1 .4 1 1v5.3c0 1.7-1.3 3-3 3z" />
                                <path fill="#1457e6"
                                    d="m21.5 10.2-1-.5-9-5c-.3-.2-.7-.2-1 0l-9 5c-.5.2-.6.8-.4 1.3.1.2.2.3.4.4l9 5c.3.2.7.2 1 0l8.5-4.7v2.9c0 .6.4 1 1 1s1-.4 1-1v-3.4c0-.5-.2-.8-.5-1z" />
                            </svg>
                            <h4 class="">{{ __('posts.posts') }}</h4>
                            <h2 class="counter tx-primary  mb-0">{{ $posts_count ? $posts_count : 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card text-center feature-card-16 mb-lg-0 secondary">
                        <div class="card-body">
                            <svg class="feature-icon br-style1 secondary mb-3" xmlns="http://www.w3.org/2000/svg"
                                height="60" width="60" viewBox="0 0 24 24">
                                <path fill="#fcbf8e"
                                    d="M10.47217,20a8.46717,8.46717,0,0,1-5.99072-2.48047h0A8.47313,8.47313,0,0,1,2.14893,9.94531a.99874.99874,0,0,1,.79638-.79687,8.47246,8.47246,0,0,1,9.90674,9.90625.99874.99874,0,0,1-.79639.79687A8.52785,8.52785,0,0,1,10.47217,20Z">
                                </path>
                                <path fill="#fcbf8e"
                                    d="M13.52783,20a8.52785,8.52785,0,0,1-1.58349-.14844.99874.99874,0,0,1-.79639-.79687,8.47246,8.47246,0,0,1,9.90674-9.90625.99874.99874,0,0,1,.79638.79687,8.47313,8.47313,0,0,1-2.33252,7.57422h0A8.47125,8.47125,0,0,1,13.52783,20Zm5.28369-3.1875h0Z">
                                </path>
                                <path fill="#fb9543"
                                    d="M12,20a.99654.99654,0,0,1-.56348-.17383,9.46579,9.46579,0,0,1,0-15.65234.99789.99789,0,0,1,1.127,0,9.46579,9.46579,0,0,1,0,15.65234A.99654.99654,0,0,1,12,20Z">
                                </path>
                            </svg>
                            <h4 class="">{{ __('order.orders') }}</h4>
                            <h2 class="counter tx-secondary  mb-0">{{ $order_count ? $order_count : 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card text-center feature-card-16 mb-lg-0 success">
                        <div class="card-body">
                            <svg class="feature-icon br-style1 success mb-3" xmlns="http://www.w3.org/2000/svg"
                                height="60" width="60" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                                <path fill="#73dfa4" d="M12 14a6 6 0 1 1 6-6 6.007 6.007 0 0 1-6 6z" />
                                <path fill="#17ca68"
                                    d="M15.7 12.713a5.975 5.975 0 0 1-7.405 0 9.992 9.992 0 0 0-6.23 8.179 1 1 0 0 0 .886 1.102L20.94 22a1 1 0 0 0 .995-1.108 9.995 9.995 0 0 0-6.233-8.179z" />
                            </svg>
                            <h4 class="">{{ __('user.All_User') }}</h4>
                            <h2 class="counter tx-success  mb-0">{{ $users_count ? $users_count : 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card text-center feature-card-16 mb-lg-0 danger">
                        <div class="card-body">
                            <svg class="feature-icon br-style1 danger mb-3" xmlns="http://www.w3.org/2000/svg"
                                height="60" width="60" data-name="Layer 1" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#ea858f" />
                                <path fill="#dc3545"
                                    d="M12 17.092a5.68 5.68 0 0 1-3.643-1.325 1 1 0 1 1 1.286-1.534 3.76 3.76 0 0 0 4.714 0 1 1 0 0 1 1.286 1.534A5.68 5.68 0 0 1 12 17.092zm-2.086-6.256a.997.997 0 0 1-.707-.293 1.033 1.033 0 0 0-1.414 0 1 1 0 1 1-1.414-1.414 3.072 3.072 0 0 1 4.242 0 1 1 0 0 1-.707 1.707zm7 0a.997.997 0 0 1-.707-.293 1.033 1.033 0 0 0-1.414 0 1 1 0 0 1-1.414-1.414 3.072 3.072 0 0 1 4.242 0 1 1 0 0 1-.707 1.707z" />
                            </svg>
                            <h4 class="">{{ __('user.providers') }}</h4>
                            <h2 class="counter tx-danger  mb-0">{{ $providers_count ? $providers_count : 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="heading-section">
                <div class="heading-subtitle"><span class="tx-primary tx-16 fw-semibold"
                        style="color: black;">{{ __('user.providers') }}</span>
                </div>
                <div class="heading-title">{{ __('user.providers') }}</div>
                <div class="heading-description"> </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                @forelse ($users as $user)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="position-relative">

                                                <a href="{{ route('web.profile', $user->id) }}">
                                                    @if ($user->image)
                                                        <img class="card-img-top" src="{{ $user->image_url }}"
                                                            alt="img">
                                                    @else
                                                        <img class="card-img-top" src="{{ asset('images/user.png') }}"
                                                            alt="img">
                                                    @endif
                                                </a>
                                                {{-- <span class="badge bg-secondary blog-badge">{{ $user->add_order }}</span> --}}
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <h5><a
                                                        href="{{ route('web.profile', $user->id) }}">{{ $user->first_name . ' ' . $user->last_name }}</a>
                                                </h5>
                                                <div class="tx-muted">{{ $user->description }}</div>
                                                <div class="d-flex align-items-center pt-4 mt-auto">
                                                    {{-- <div class="avatar me-3 cover-image rounded-circle">
                                                            <img src="{{ $user->image_url ?? asset('images/user.png') }}"
                                                                class="rounded-circle" alt="img" width="40">
                                                        </div> --}}
                                                    <div>
                                                        <div class="stars-card d-flex align-items-center ">
                                                            @php
                                                                $i = 5;

                                                                $rate = $user->rates();
                                                            @endphp
                                                            @if ($user->role_id == 3)
                                                                <div class="stars-card d-flex align-items-center ">


                                                                    @while (--$i >= 5 - $rate)
                                                                        <i data-feather="star" width="20"
                                                                            height="20" class="active"></i>
                                                                    @endwhile
                                                                    @while ($i-- >= 0)
                                                                        <i data-feather="star" width="20"
                                                                            height="20" class=""></i>
                                                                    @endwhile
                                                                    <span
                                                                        class="badge badge-primary ml-10 bg-primary">{{ $rate }}</span>

                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    {{-- <div class="ms-auto">
                                                    <a href="javascript:void(0)" class="icon d-inline-block tx-muted"><i class="fe fe-heart me-1 rounded-circle p-2 bg-gray-200 tx-muted"></i></a>
                                                </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    {!! no_data() !!}
                                @endforelse

                            </div>

                        </div>
                        <!-- COL-END -->

                        {{-- <div class="card">
                                <div class="card-body">
                                    <form action="javascript:void(0);" class="form">
                                        <div class="form-group custom-form-group">
                                            <input type="text" class="form-control form-control-lg rounded-pill" placeholder="Find your Blog here...">
                                            <button class="custom-form-btn btn btn-lg btn-primary bg-primary-gradient rounded-pill border-0" type="button" id="btn-addon">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}



                        {{-- <div class="card">
                                <div class="card-body">
                                    <p class="h5 mb-4">Tags</p>
                                    <div class="tags">
                                        <a href="javascript:void(0)" class="tag">Hosting</a>
                                        <a href="javascript:void(0)" class="tag">Servers</a>
                                        <a href="javascript:void(0)" class="tag">Email</a>
                                        <a href="javascript:void(0)" class="tag">Linux Servers</a>
                                        <a href="javascript:void(0)" class="tag">Windows Servers</a>
                                        <a href="javascript:void(0)" class="tag">KVM Servers</a>
                                        <a href="javascript:void(0)" class="tag">Domain Transfer</a>
                                        <a href="javascript:void(0)" class="tag">Domain Registration</a>
                                    </div>
                                </div>
                            </div> --}}

                    </div>
                    {{-- </div> --}}
                </div>
            </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="heading-section">
                <div class="heading-subtitle"><span class="tx-primary tx-16 fw-semibold"
                        style="color: black;">{{ __('general.about_us') }}</span></div>
                <div class="heading-title">{{ __('general.about_us') }}</div>
                <div class="heading-description"> </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            @if ($settings->about_us)
                                <p>{{ $settings->about_us }}</p>
                            @else
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam voluptatem at sunt
                                    incidunt nobis rerum magni sint blanditiis autem distinctio. Blanditiis iste quae eius
                                    provident quo ea molestias, temporibus commodi?</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>

    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection
@section('script')
    <script src="{{ asset('js/feather-icons/dist/feather.min.js') }}"></script>
    <script>
        feather.replace();
    </script>
@endsection
