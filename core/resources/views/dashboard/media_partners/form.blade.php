@extends('dashboard.layouts.master')

@section('title', $mediaPartner->exists ? 'Edit Media Partner' : 'Add Media Partner')

@section('content')
    @php
        $categories = ['Coverage Themes', 'Promotion', 'Confirmed Media Partners'];
        $statuses = ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'];
        $formRoute = $mediaPartner->exists ? route('mediaPartners.update', $mediaPartner) : route('mediaPartners.storeAdmin');
    @endphp

    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ $mediaPartner->exists ? 'Edit Media Partner' : 'Add Media Partner' }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('mediaPartners.index') }}">Media Partners</a> /
                    <span>{{ $mediaPartner->exists ? 'Edit' : 'Add' }}</span>
                </small>
            </div>

            <form action="{{ $formRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company name</label>
                                <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $mediaPartner->company_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $mediaPartner->email) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control c-select" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" @selected(old('category', $mediaPartner->category) === $category)>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control c-select" required>
                                    @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', $mediaPartner->status) === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Website</label>
                                <input type="url" name="website" class="form-control" value="{{ old('website', $mediaPartner->website) }}" placeholder="https://example.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png,.webp,.svg" {{ $mediaPartner->exists ? '' : 'required' }}>
                                @if($mediaPartner->logo)
                                    <div class="m-t-sm">
                                        <img src="{{ asset('uploads/media_partners/'.$mediaPartner->logo) }}" alt="{{ $mediaPartner->company_name }}" style="max-width:160px;max-height:74px;background:#fff;padding:8px;border-radius:4px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message" class="form-control" rows="5">{{ old('message', $mediaPartner->message) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="dker p-a text-right">
                    <a href="{{ route('mediaPartners.index') }}" class="btn dark-white">Cancel</a>
                    <button type="submit" class="btn primary">{{ $mediaPartner->exists ? __('backend.save') : __('backend.add') }}</button>
                </footer>
            </form>
        </div>
    </div>
@endsection
