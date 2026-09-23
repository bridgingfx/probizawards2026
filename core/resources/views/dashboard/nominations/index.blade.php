@extends('dashboard.layouts.master')

@section('title', 'Nominations')

@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>ProBiz Awards 2026 Nominations</h2>
                <small>Latest nomination submissions</small>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t">
                    <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Company</th>
                        <th>Nominee</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Pillar</th>
                        <th>Award</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Submitted</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($nominations as $nomination)
                        <tr>
                            <td>{{ $nomination->reference_id ?? '-' }}</td>
                            <td>{{ $nomination->company }}</td>
                            <td>{{ $nomination->nominee_name ?? $nomination->company }}<br><small>{{ $nomination->nomination_type ?? 'Business' }}</small></td>
                            <td>{{ $nomination->contact }}<br><small>{{ $nomination->jobtitle }}</small></td>
                            <td>{{ $nomination->email }}</td>
                            <td>{{ $nomination->phone }}</td>
                            <td>{{ $nomination->category }}</td>
                            <td>{{ $nomination->subcategory }}</td>
                            <td>{{ $nomination->emirate ?? $nomination->country }}<br><small>{{ $nomination->branch_location }}</small></td>
                            <td>{{ str_replace('_', ' ', $nomination->nomination_state ?? 'received') }}</td>
                            <td>{{ optional($nomination->created_at)->format('Y-m-d H:i') }}</td>
                        </tr>
                        <tr>
                            <td colspan="10">
                                <strong>Statement:</strong> {{ $nomination->statement }}<br>
                                <strong>Description:</strong> {{ $nomination->description }}<br>
                                @if($nomination->website)
                                    <strong>Website:</strong> {{ $nomination->website }}<br>
                                @endif
                                @if($nomination->supporting_evidence_path)
                                    <strong>Evidence file:</strong> {{ $nomination->supporting_evidence_path }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No nominations yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($nominations->hasPages())
                <div class="box-footer text-center">
                    {{ $nominations->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
