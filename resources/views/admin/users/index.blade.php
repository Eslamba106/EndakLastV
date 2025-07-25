@extends('layouts.dashboard.dashboard')
@section('title')
    {{ __('user.All_User') }}
@endsection

@section('page_name')
    {{ __('user.All_User') }}
@endsection
@section('content')
<?php $lang = config('app.locale'); ?>
    <form action="" method="get">

        <div class="col-md-12 ">
            <div class="input-group mb-3 d-flex justify-content-end">
                <div class="remv_control mr-2">
                    <select name="status" class="mr-3 mt-3 form-control remv_focus">
                        <option value="">{{__('posts.set_status')}}</option>
                        <option value="1" {{selected('1', request('status'))}}>{{__('posts.active')}}</option>
                        <option value="2" {{selected('2', request('status'))}}>{{__('user.disactive')}}</option>
                        <option value="3" {{selected('3', request('status'))}}>{{__('user.banned')}}</option>
                    </select>
                </div>
                <div class="remv_control mr-2">
                    <select name="role" class="mr-3 mt-3 form-control remv_focus">
                        <option value="">{{__('user.set_role')}}</option>
                        <option value="3" {{selected('3', request('role'))}}>{{__('user.service_provider')}}</option>
                        <option value="1" {{selected('1', request('role'))}}>{{__('user.user')}}</option>
                        {{-- <option value="3" {{selected('3', request('status'))}}>{{__('posts.banned')}}</option> --}}
                    </select>
                </div>

                {{-- <a href="{{route('offer_create')}}" class="btn btn-primary mt-3 mr-2" data-toggle="tooltip" title="@lang('admin.offer_add')"> <i class="la la-plus"></i> </a> --}}


                <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mt-3 mr-2">
                    <i class="la la-refresh"></i> {{__('general.update')}}
                </button>

                <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm mt-3 mr-2"> <i class="la la-trash"></i> {{__('general.delete')}}</button>
            </div>
        </div>
        <div class="col-sm-12">
            @if ($users->count())
                <div class="cls_table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input class="bulk_check_all" type="checkbox" /></th>
                                <th>@lang('user.name')</th>
                                <th>@lang('user.email')</th>
                                <th>@lang('user.status')</th>
                                <th>@lang('user.phone')</th>
                                <th>@lang('user.city')</th>
                                <th>@lang('user.type')</th>
                                <th>الأقسام المشترك بها</th>
                                <th>{{ __('user.created_at') }}</th>
                                <th>@lang('general.actions')</th>
                            </tr>
                        </thead>

                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                            value="{{ $user->id }}" />
                                        <span class="text-muted">#{{ $user->id }}</span>
                                    </label>
                                </td>
                                <td>{{ $user->first_name ." " . $user->last_name }} </td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->status }} </td> {{-- {{ ($invoice->invoice_status == 'paid') ? "badge-success" : "badge-warning" }} --}}
                                <td>{{ $user->phone }} </td>
                                <td>{{ $user->governementObj?->name_ar ?? '-' }} </td>
                                <td>{{ $user->role_name }} </td>
                                <td>
                                    @php
                                        $mainDeps = $user->userDepartments->where('commentable_type', App\Models\Department::class);
                                        $subDeps = $user->userDepartments->where('commentable_type', App\Models\SubDepartment::class);
                                    @endphp
                                    {{-- الأقسام الرئيسية --}}
                                    @foreach($mainDeps as $dep)
                                        <span class="badge badge-info">
                                            {{ optional(App\Models\Department::find($dep->commentable_id))->name_ar ?? '-' }}
                                        </span>
                                    @endforeach
                                    {{-- الأقسام الفرعية --}}
                                    @foreach($subDeps as $dep)
                                        <span class="badge badge-secondary">
                                            {{ optional(App\Models\SubDepartment::find($dep->commentable_id))->name_ar ?? '-' }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{{ $user->created_at->shortAbsoluteDiffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.user_management.show', $user->id) }}" class="btn btn-purple"><i
                                            class="la la-eye" title="@lang('general.show')"></i> </a>


                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                {!! no_data() !!}
            @endif

            {!! $users->links() !!}

        </div>
    </form>

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

