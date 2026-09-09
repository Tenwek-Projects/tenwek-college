@php $board = new \App\Models\CohsBoardMember; @endphp
<x-layouts.admin header="Add board member">
    <form method="post" action="{{ route('admin.cohs.board.store') }}" enctype="multipart/form-data" class="admin-page-narrow">
        <div class="admin-card p-6 sm:p-8">
            @csrf
            <div class="admin-form-stack">
                @include('admin.cohs.board._form')
            </div>
            <div class="admin-actions admin-actions-sticky mt-8">
                <div class="admin-actions-primary">
                    <button type="submit" class="admin-btn-primary">Save</button>
                    <a href="{{ route('admin.cohs.board.index') }}" class="admin-btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</x-layouts.admin>
