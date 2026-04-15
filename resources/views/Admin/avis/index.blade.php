@extends('layouts.admin')
@section('title', 'Avis')
@section('page_title', 'Gestion des avis')
@section('nav_avis', 'active')

@section('content')
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>Client</th><th>Note</th><th>Commentaire</th><th>Date</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @forelse($avis as $a)
                    <tr>
                        <td><strong>{{ $a->user->name }}</strong></td>
                        <td>
                            @for($i=1;$i<=5;$i++)
                                <i class="fas fa-star {{ $i<=$a->note ? '' : 'text-muted' }}" style="{{ $i<=$a->note?'color:#c9a84c':'' }}"></i>
                            @endfor
                        </td>
                        <td>{{ Str::limit($a->commentaire, 80) }}</td>
                        <td class="text-muted small">{{ $a->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.avis.destroy', $a) }}" class="d-inline"
                                  onsubmit="return confirm('Supprimer cet avis ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Aucun avis.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($avis->hasPages())
    <div class="card-footer bg-white">{{ $avis->links() }}</div>
    @endif
</div>
@endsection