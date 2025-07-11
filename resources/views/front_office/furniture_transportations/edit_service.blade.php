@extends('layouts.home')
@section('title')
    <?php
    $lang = config('app.locale');
    ?>
    {{ $lang == 'ar' ? 'نقل عفش' : 'Furniture Transportations' }}
@endsection

@section('content')

    <div class="main-content app-content">
        <section>
            <div class="section banner-4 banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center">
                            <div class="">
                                <p class="mb-3 content-1 h5 fs-1">
                                    {{ $lang == 'ar' ? 'نقل عفش' : 'Furniture Transportations' }}

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="profile-cover-container mb-2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-content pt-40">


            <div class="container position-relative d-flex justify-content-center mt-4">
                <?php $user = auth()->user(); ?>
                <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data"
                    style="width:100%" class="profile-card rounded-lg shadow-xs bg-white p-15 p-md-30">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="department_id" value="{{ $service->department_id }}">
                    <input type="hidden" name="type" value="{{ $service->type }}">

                    @foreach ($products as $product)
                        @php
                            $isSelected = in_array($product->id, $selectedProducts ?? []);
                            $quantity = $quantities[$product->id] ?? null;
                        @endphp
                        <div class="form-group mt-2 d-flex align-items-center">
                            <input type="checkbox" name="selected_products[]" id="product-{{ $product->id }}"
                                value="{{ $product->id }}" class="m-2" {{ $isSelected ? 'checked' : '' }}>

                            <div class="d-flex align-items-center justify-content-between m-2">
                                <label for="product-{{ $product->id }}" class="ml-2 mr-3">
                                    {{ $lang == 'ar' ? $product->name_ar : $product->name_en }}
                                </label>
                                <img src="{{ $product->image_url }}" width="50" height="50" alt=""
                                    style="margin-right: 15px;">
                                <input max="10" class="form-control m-2" type="number"
                                    name="quantities[{{ $product->id }}]" placeholder="الكمية"
                                    style="width: 80px; {{ $isSelected ? '' : 'display: none;' }}"
                                    id="quantity-{{ $product->id }}" min="1" value="{{ $quantity }}">
                            </div>

                            <div>
                                <label>
                                    <input type="checkbox" name="disassembly[{{ $product->id }}]" value="1"
                                        class="m-2" {{ isset($disassembly[$product->id]) ? 'checked' : '' }}>
                                    {{ $lang == 'ar' ? 'فك' : 'Disassembly' }}
                                </label>
                                <label>
                                    <input type="checkbox" name="installation[{{ $product->id }}]" value="1"
                                        class="m-2" {{ isset($installation[$product->id]) ? 'checked' : '' }}>
                                    {{ $lang == 'ar' ? 'تركيب' : 'Installation' }}
                                </label>
                            </div>
                        </div>
                    @endforeach

                    <label class="mb-1">{{ $lang == 'ar' ? 'من' : 'From' }} :</label>
                    <div class="form-group mt-2">
                        <label class="mb-1">{{ $lang == 'ar' ? 'المدينة' : 'City' }} :</label>
                        <select name="from_city" class="form-control js-select2-custom">
                            <option value="">{{ __('اختر المدينة') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ $service->from_city == $city->id ? 'selected' : '' }}>
                                    {{ $lang == 'ar' ? $city->name_ar : $city->name_en }}
                                </option>
                            @endforeach
                        </select>

                        <label class="mb-1">{{ $lang == 'ar' ? 'الحي' : 'Neighborhood' }} :</label>
                        <input type="text" class="form-control" name="from_neighborhood"
                            value="{{ $service->from_neighborhood }}">

                        <label class="mb-1">{{ $lang == 'ar' ? 'الدور' : 'Home' }} :</label>
                        <select name="location" class="form-control js-select2-custom">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ $service->location == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <hr>

                    <label class="mb-1">{{ $lang == 'ar' ? 'الي' : 'To' }} :</label>
                    <div class="form-group mt-2">
                        <label class="mb-1">{{ $lang == 'ar' ? 'المدينة' : 'City' }} :</label>
                        <select name="to_city" class="form-control js-select2-custom">
                            <option value="">{{ __('اختر المدينة') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ $service->to_city == $city->id ? 'selected' : '' }}>
                                    {{ $lang == 'ar' ? $city->name_ar : $city->name_en }}
                                </option>
                            @endforeach
                        </select>

                        <label class="mb-1">{{ $lang == 'ar' ? 'الحي' : 'Neighborhood' }} :</label>
                        <input type="text" class="form-control" name="to_neighborhood"
                            value="{{ $service->to_neighborhood }}">

                        <label class="mb-1">{{ $lang == 'ar' ? 'الدور' : 'Home' }} :</label>
                        <select name="part_number" class="form-control js-select2-custom">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ $service->part_number == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mb-1">{{ $lang == 'ar' ? 'ملاحظة عن العمل المطلوب' : 'Note About Work' }} :</label>
                        <textarea class="form-control" name="notes" rows="5">{{ $service->notes }}</textarea>
                    </div>

                    <div class="voice-note-container">
                        <div id="recordingStatus" style="margin-bottom: 8px; color: #d9534f; display: none;"></div>
                        <button id="startRecord"
                            class="btn btn-primary">{{ $lang == 'ar' ? 'بدء التسجيل' : 'Start Recording' }}</button>
                        <button id="stopRecord" class="btn btn-danger"
                            disabled>{{ $lang == 'ar' ? 'ايقاف التسجيل' : 'Stop Recording' }}</button>
                        <button id="resetRecord" class="btn btn-secondary"
                            style="display:none;">{{ $lang == 'ar' ? 'إعادة التسجيل' : 'Reset Recording' }}</button>
                        <span id="recordingTimer" style="margin-left: 10px; font-weight: bold; display:none;">00:00</span>
                        <audio id="audioPlayback" controls style="display: none; margin-top: 10px;"></audio>
                        <a id="downloadLink" style="display: none; margin-top: 10px;"
                            class="btn btn-success">{{ $lang == 'ar' ? 'تنزيل التسجيل' : 'Download Recording' }}</a>
                    </div>

                    <div class="form-group mt-3 text-end">
                        <button type="submit" class="btn btn-warning w-100">
                            {{ $lang == 'ar' ? 'تحديث' : 'Update' }}
                        </button>
                    </div>
                </form>

            </div>



        </div>


    </section>



@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script>
        document.querySelectorAll('input[type=checkbox][name="selected_products[]"]').forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const quantityInput = document.getElementById(`quantity-${this.value}`);
                if (this.checked) {
                    quantityInput.style.display = 'block';
                } else {
                    quantityInput.style.display = 'none';
                    quantityInput.value = '';
                }
            });
        });
    </script>
@endsection
