@extends('dashboard.layouts.master')

@section('title', 'Media Partners')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>ProBiz Media Partners</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <span>Media Partners</span>
                </small>
            </div>

            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="btn btn-fw primary" href="{{ route('mediaPartners.create') }}">
                            <i class="material-icons">&#xe145;</i> Add Media Partner
                        </a>
                    </li>
                </ul>
            </div>

            @if($mediaPartners->total() == 0)
                <div class="row p-a">
                    <div class="col-sm-12">
                        <div class="p-a text-center">
                            <div class="text-muted m-b"><i class="fa fa-newspaper-o fa-4x"></i></div>
                            <h6>No media partner submissions yet.</h6>
                        </div>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered m-a-0">
                        <thead class="dker">
                        <tr>
                            <th>Logo</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th class="text-center" style="width:190px;">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mediaPartners as $mediaPartner)
                            <tr>
                                <td style="width:120px;">
                                    @if($mediaPartner->logo)
                                        <img src="{{ asset('uploads/media_partners/'.$mediaPartner->logo) }}" alt="{{ $mediaPartner->company_name }}" style="max-width:100px;max-height:54px;background:#fff;padding:6px;border-radius:4px;">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $mediaPartner->company_name }}</strong>
                                    @if($mediaPartner->message)
                                        <br><small>{{ \Illuminate\Support\Str::limit($mediaPartner->message, 120) }}</small>
                                    @endif
                                </td>
                                <td>{{ $mediaPartner->email ?: '-' }}</td>
                                <td>{{ $mediaPartner->category }}</td>
                                <td>
                                    @if($mediaPartner->website)
                                        <a href="{{ $mediaPartner->website }}" target="_blank" rel="noopener noreferrer">{{ $mediaPartner->website }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($mediaPartner->status === 'approved')
                                        <span class="label success">Approved</span>
                                    @elseif($mediaPartner->status === 'rejected')
                                        <span class="label danger">Rejected</span>
                                    @else
                                        <span class="label warn">Pending</span>
                                    @endif
                                </td>
                                <td>{{ optional($mediaPartner->created_at)->format('Y-m-d H:i') }}</td>
                                <td class="text-center">
                                    @if($mediaPartner->status !== 'approved')
                                        <form action="{{ route('mediaPartners.approve', $mediaPartner) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm info" data-toggle="tooltip" data-original-title="Approve">
                                                <i class="material-icons">&#xe876;</i>
                                            </button>
                                        </form>
                                    @endif
                                    <a class="btn btn-sm success" href="{{ route('mediaPartners.edit', $mediaPartner) }}" data-toggle="tooltip" data-original-title="{{ __('backend.edit') }}">
                                        <i class="material-icons">&#xe3c9;</i>
                                    </a>
                                    <button type="button" class="btn btn-sm warning" onclick="DeleteMediaPartner('{{ $mediaPartner->id }}', '{{ addslashes($mediaPartner->company_name) }}')" data-toggle="tooltip" data-original-title="{{ __('backend.delete') }}">
                                        <i class="material-icons">&#xe872;</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <footer class="dker p-a">
                    <div class="row">
                        <div class="col-sm-6">
                            <small class="text-muted inline m-t-sm m-b-sm">
                                Showing {{ $mediaPartners->firstItem() }} - {{ $mediaPartners->lastItem() }} of <strong>{{ $mediaPartners->total() }}</strong> records
                            </small>
                        </div>
                        <div class="col-sm-6 text-right text-center-xs">
                            {!! $mediaPartners->links() !!}
                        </div>
                    </div>
                </footer>
            @endif
        </div>
    </div>

    <div id="DeleteMediaPartner" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        {{ __('backend.confirmationDeleteMsg') }}
                        <br>
                        [ <strong class="record-title"></strong> ]
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">{{ __('backend.no') }}</button>
                    <a id="DeleteMediaPartnerBtn" href="" class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        function DeleteMediaPartner(id, title) {
            $("#DeleteMediaPartner").modal("show");
            $("#DeleteMediaPartner .record-title").html(title);
            $("#DeleteMediaPartnerBtn").attr("href", "{{ url(config('smartend.backend_path').'/media-partners') }}/" + id + "/destroy");
        }
    </script>
@endpush
